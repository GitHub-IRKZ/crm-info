<?php declare(strict_types=1);

namespace Irkz\Crminfo\Console\Commands;

use DateTime;
use DateTimeZone;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

/**
 * Команда для получения информации из CRM
 */
class CrminfoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ir:crm-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get information from CRM';

    /**
     * Execute the console command.
     *
     * @return bool|string
     * @throws \Exception
     */
    public function handle(): bool|string
    {
        $fileName    = config('crm-info.fileName');
        $disk        = config('crm-info.storage');
        $currentDate = (new DateTime('now', new DateTimeZone(config('app.timezone'))));

        // если файла нет, то создаем его и записываем в него информацию
        if (!Storage::disk($disk)->exists($fileName)) {
            return $this->putInfo();
        }

        try {
            $information = json_decode(Storage::disk($disk)->get($fileName), true);

            if ($currentDate > new DateTime($information['expireAt'])) {
                return $this->putInfo();
            }
        } catch (\Throwable $throwable) {
            Log::error('[ir-crm] Ошибка при получении информации', [
                'exception' => $throwable
            ]);
        }

        return false;
    }

    /**
     * Сохраняет информацию в файл
     *
     * @return bool|string
     */
    private function putInfo(): bool|string
    {
        try {
            /** @var \Irkz\Crminfo\Client\Response\InformationResponse $information */
            $information = app('crm-info')->getInfo();

            if ($information->getStatusCode() !== Response::HTTP_OK) {
                $this->error('Ошибка при получении информации из CRM');

                return false;
            }

            $expirationDate = (new \DateTimeImmutable('now', new \DateTimeZone(config('app.timezone'))))
                ->add(new \DateInterval(config('crm-info.timeUntilUpdate')));

            return Storage::disk(config('crm-info.storage'))->put(config('crm-info.fileName'), json_encode([
                'expireAt' => $expirationDate->format(DATE_ATOM),
                'data'     => $information->getContents(),
            ]));
        } catch (\Throwable $e) {
            Log::error('Ошибка при получении информации из CRM ', [
                'exception' => $e->getMessage()
            ]);
        }

        return false;
    }
}

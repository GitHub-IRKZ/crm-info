@if(!$isError)
    <div class="card-body text-center mb-3">
        <div>
            <h2>CMS IRsite v3.1</h2>

            <h5 style="font-size: 15px;">
                Служба поддержки клиентов - <a href="https://support.ir.kz" target="_blank" class="text-white">
                    support.ir.kz
                </a>
            </h5>

            <div class="row my-3">
                <div class="col-md-4 text-right"><b>Телефон:</b></div>
                <div class="col-md-8 text-left">
                    {{ $companyPhone }} <br /> {{ $companyMobile }}
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer position-absolute fixed-bottom" style="background: none; border-color: #c2cfd6;">
        &copy; Copyright {{ date('Y') }}, {{ $companyName ?? 'IR.KZ' }} <br/>

        <small class="text-muted" style="font-size: 11px;">
            Свидетельство ИС 04145, № 205 от 09 марта 2010 года
        </small>
    </div>
@else

@endif
Клиент для получения информации о проекте из CRM
------------------------------------------------

Клиент для получения информации о проекте из CRM системы.

### Установка

```bash
$ composer require ir/crm-info
```

Далее, в шаблоне админ панели, в `resources/views/avl/blocks/footer.blade.php`
заменить блок `<footer class="app-footer">` на `<x-crm-info-footer />`

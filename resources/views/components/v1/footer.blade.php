<footer class="app-footer">
    @if(!$isError)
        <span>
            <b>Телефон:</b> {{ $companyPhone }}, {{ $companyMobile }}
        </span>
    @else
        <span>
            Ваша лицензия недействительна. Для получения лицензии обратитесь по адресу <a href="mailto:support@ir.kz">support@ir.kz</a>
        </span>
    @endif

    <span class="ml-auto">
        &copy; Copyright {{ date('Y') }}, <a href="https://ir.kz">{{ $companyName ?? "IR.KZ" }}</a>
    </span>
</footer>

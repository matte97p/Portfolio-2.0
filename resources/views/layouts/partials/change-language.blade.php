<div class="dropdown">
    <button type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <x-icon name="flag-language-{{ App::currentLocale() }}" alt="{{ App::isLocale('en') ? 'English' : 'Italiano' }}" width="32" height="32" />
        {{ App::isLocale('en') ? 'English' : 'Italiano' }}
    </button>
    <div class="dropdown-menu">
        <div class="p-2">
            <a href="{{ route('locale', ['locale' => 'en']) }}" class="dropdown-item d-flex align-items-center justify-content-between">
            <x-icon name="flag-language-en" width="32" height="32" />
                <span>{{ 'English' }}</span>
            </a>
            <a href="{{ route('locale', ['locale' => 'it']) }}" class="dropdown-item d-flex align-items-center justify-content-between">
                <x-icon name="flag-language-it" width="32" height="32" />
                <span>{{ 'Italiano' }}</span>
            </a>
        </div>
    </div>
</div>
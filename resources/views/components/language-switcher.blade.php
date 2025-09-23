@props(['currentLocale' => app()->getLocale(), 'availableLocales' => config('app.available_locales', [])])

@php
    $rtlLanguages = ['ha']; // Languages that support RTL (Arabic script)
    $currentIsRtl = in_array($currentLocale, $rtlLanguages);
@endphp

<div class="dropdown" @if($currentIsRtl) dir="rtl" @endif>
    <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-globe me-2" aria-hidden="true"></i>
        <span class="d-none d-md-inline">{{ $availableLocales[$currentLocale]['native'] ?? $currentLocale }}</span>
        <span class="d-md-none">{{ strtoupper($currentLocale) }}</span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
        @foreach($availableLocales as $locale => $language)
            @php
                $isRtl = in_array($locale, $rtlLanguages);
            @endphp
            <li>
                <a class="dropdown-item {{ $currentLocale === $locale ? 'active' : '' }} text-start"
                   href="{{ route('language.switch', $locale) }}"
                   hreflang="{{ $locale }}"
                   lang="{{ $locale }}">
                    <span class="ms-2">{{ $language['native'] }}</span>
                    <small class="text-muted">({{ $language['name'] }})</small>
                </a>
            </li>
        @endforeach
    </ul>
</div>
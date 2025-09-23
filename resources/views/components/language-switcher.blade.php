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
            <li @if($isRtl) dir="rtl" @endif>
                <a class="dropdown-item {{ $currentLocale === $locale ? 'active' : '' }}"
                   href="{{ route('language.switch', $locale) }}"
                   hreflang="{{ $locale }}"
                   lang="{{ $locale }}"
                   @if($isRtl) dir="rtl" @endif>
                    <span class="@if($isRtl) me-2 @else ms-2 @endif">{{ $language['native'] }}</span>
                    <small class="text-muted">({{ $language['name'] }})</small>
                </a>
            </li>
        @endforeach
    </ul>
</div>
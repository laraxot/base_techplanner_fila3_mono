# Tema Sixteen - Documentazione

## Panoramica

Tema moderno per Laravel conforme alle Linee Guida di Design PA, implementato con Tailwind CSS (niente Bootstrap Italia diretto). Accessibilità WCAG 2.1 AA, “tema come vestito”: la logica dei form è nei widget Filament, le view del tema sono wrapper grafici.

## Struttura
```
Themes/Sixteen/
├── docs/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   ├── pages/
│   │   └── components/
│   ├── css/
│   └── js/
├── tailwind.config.js
├── vite.config.js
└── package.json
```

## Regole chiave
- Namespace viste: `pub_theme::...`
- Login page: usa `@livewire(\Modules\User\Filament\Widgets\Auth\LoginWidget::class)`
- Niente stringhe hardcoded: usare file di traduzione
- Build: Vite outDir `./public`, Tailwind senza preset Filament locali

## Accessibilità
- Skip links, focus visibile, contrasti conformi
- Semantica corretta e supporto screen reader

## Build
```bash
npm install
npm run build
```

## Collegamenti
- Vedi anche: docs/merge_conflict_resolution.md (root) per policy di risoluzione conflitti

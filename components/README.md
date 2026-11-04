# Workshopr Design System — Portable Components

Reusable component implementations of every `ws_*` component and design pattern,
in two flavors:

- **`php/`** — namespaced PHP (`Workshopr\DS\*`) standalone functions returning HTML strings.
  Mirror the global `ws_*` helpers but are portable and collision-free (you can load these
  without `includes/components/helpers.php`).
- **`react/`** — TypeScript (`.tsx`) function components with typed props (`Ws<Name>Props`).

## Shared rules (both flavors)

1. **Styling is never duplicated.** Components render the existing `ws-*` class names from
   `includes/components/components.css`, which already consumes `design-system/platform-tokens.css`.
   No hardcoded colors, sizes, or fonts — markup only.
2. **Icons** use Google Material Symbols via the shared helper (`Workshopr\DS\icon()` /
   `<Icon name="…" />`).
3. **Parity.** Class names and structure match the canonical templates in
   `includes/components/*.php` so PHP, React, and the live site stay visually identical.

## PHP usage

```php
require_once __DIR__ . '/php/index.php';   // loads all components
use function Workshopr\DS\button;
echo button('Save', ['variant' => 'primary', 'icon' => 'save']);
```

## React usage

```tsx
import { WsButton } from './react';
<WsButton text="Save" variant="primary" icon="save" />
```

> Consuming apps must include `includes/components/components.css` (and
> `design-system/platform-tokens.css`) for the components to be styled, plus the
> Material Symbols font for icons.

## Patterns caveat

The 6 **pattern** components (`PageBackground`, `Section`, `CategoryIcon`, `AppSwitcher`,
`UserMenu`, `PageTemplate`) faithfully emit the class names documented in
`design-system/patterns/patterns.php`. Unlike the `ws-*` component classes (all defined in
`includes/components/components.css`), some pattern classes are **not** in a shared stylesheet:

- `gn-switcher*` / user-menu styles live **inline in `includes/global-header.php`** — pull those
  styles (or that header) when using `AppSwitcher` / `UserMenu` standalone.
- `section-light/alt/navy/…` and `bg-pattern-grid/dots` are documented in
  `patterns.php` / `utilities.php` but are **not yet shipped as reusable CSS rules**. Add them to a
  shared stylesheet if you consume `Section` / `PageBackground` outside the pages that define them.

## Index

PHP: `php/index.php` requires every component. React: `react/index.ts` re-exports every component.

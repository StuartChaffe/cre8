# Changelog

All notable changes to this project will be documented in this file.
The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/).

## 2026-11-02 (BEM class names)

### Changed
- All class names follow BEM, matching the kestrels conventions: each block is named after its ACF block (`.card-grid__card`, `.hero-slider__dot`), with `.container`, `.btn`, `is-` states and `u-` utilities. Elements are styled by class rather than by tag
- Layout parts renamed: `.site-header__*`, `.primary-nav__*`, `.search-form`, `.site-footer__*`, `.page-header` (was `.inner-hero`, and `partials/page-header.php`), `.post-card`, `.facts`
- The "Discuss a project" form's step headings and field classes use `.project-form__*`; Gravity Forms buttons `@extend .btn`
- `Cre8_Flat_Walker` takes a class for its links

### Fixed
- Tag selectors that leaked: the CTA eyebrow had the wrong margins, the Split Media eyebrow was grey instead of pink, and the PRINCE2 mark in the trust strip was shrunk to small grey text

## 2026-10-30 (product page)

### Added
- Product Detail block: image gallery with thumbnails, description, key points, datasheet download and optional second link
- LIMSNT CSC product page under Products, with a redirect from /LIMSNT-CSC.aspx

### Fixed
- Links, buttons and slider controls in block previews no longer respond to clicks in the editor, so clicking selects the block
- Product card image link is hidden from screen readers, as it repeats the "View product" link

## 2026-10-30 (favicon)

### Added
- Favicon and Apple touch icon from the Cre8 wordmark (`src/images/favicon/`), output by `cre8_favicons()` unless a Site Icon is set

## 2026-10-30 (Gravity Forms)

### Changed
- "Discuss a project" is now a Gravity Form, created from `lib/gravity-forms.php`, with saved entries, notifications and a honeypot; styled by the theme

### Removed
- Custom form handler (`lib/project-form.php`) and the one-off content importer (`lib/importer.php`)

## 2026-10-30 (Whistlefish design)

### Added
- Design from the Whistlefish prototype: dark theme, pink accents, Inter, fixed header with dropdown menus, search, phone and project button
- Blocks: Hero Slider, Trust Strip, Card Grid, Sector Grid, Product Cards, About Split, Split Media, CTA Band, Latest Posts; Page Header and Content Block rebuilt
- "Discuss a project" page template (`tpl-project.php`) with a step-by-step form, emailed by `lib/project-form.php`
- Theme Options field group in `acf-json/` (contact details, header button, social links, enquiry email, notices)
- Content importer (Tools → Import Cre8 content) and 301 redirects from the old `.aspx` addresses
- Footer menus: Explore, Connect and Legal

### Changed
- Inter replaces DM Sans and Instrument Serif
- Blog, single post, archive, search and 404 templates restyled with the inner hero
- jQuery is no longer loaded

### Removed
- Kestrels blocks (Accordion, Image Gallery, Page Links), styles, images and the Swiper dependency

## 2026-10-30 (set-up)

### Added
- New theme for Cre8, copied from the kestrels theme (Origin starter by Marc Jenkins), with its blocks, self-hosted fonts, build set-up and deploy workflow
- Local development at `cre8.test` (Laravel Valet / Herd)

### Changed
- Deploy workflow runs by hand only until hosting is decided; pushes to `main` no longer deploy

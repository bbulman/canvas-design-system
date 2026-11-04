# TEMPLATE — Foundation Doc

<!-- Copy into /design-system/<topic>.md. Fixed section order per
     templates/README.md. Fill every section; "Exceptions: none" is a
     valid entry, silence is not. -->

| | |
|---|---|
| **Status** | beta <!-- stable / beta / deprecated --> |
| **Governs** | one line: the visual property this doc owns |
| **Source of truth** | the file(s) where the values live |
| **Guards** | the checks that keep it honest (ds-lint, check-drift, dtcg) |

## Purpose

Two sentences: what this foundation governs and why it exists.

## Principles

The rules of thumb, before any numbers. 3–6 bullets a designer can apply
without opening the spec table.

## Specification

| Token | Value | Use for |
|---|---|---|
| `--example` | `…` | … |

## Usage

```css
/* Correct */
.thing { transition: transform var(--duration-base) var(--ease-out); }

/* Wrong — hardcoded values where tokens exist */
.thing { transition: transform 200ms ease; }
```

## Exceptions

Every documented deviation, each with where it's recorded and why it exists.

| Exception | Recorded in | Why |
|---|---|---|
| … | … | … |

## Related

- Sibling docs, consuming components, decision records.

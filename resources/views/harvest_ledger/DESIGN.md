# Design System Strategy: The Artisanal Ledger

## 1. Overview & Creative North Star

This design system is built upon the Creative North Star of **"The Artisanal Ledger."** 

We are moving away from the "SaaS-standard" look—characterized by rigid borders and generic shadows—and moving toward a high-end editorial experience. The system treats food management not as a chore, but as a curated craft. By utilizing intentional asymmetry, sophisticated tonal layering, and high-contrast typography, we create an interface that feels like a premium culinary journal. The layout breathes through expansive whitespace, while depth is communicated through material shifts rather than structural lines.

---

## 2. Color Architecture & The "No-Line" Rule

The palette transitions from deep, organic forest tones to vibrant, sun-ripened citrus. We utilize a sophisticated Material-based token system to ensure harmony.

### The "No-Line" Rule
**Strict Mandate:** Designers are prohibited from using 1px solid borders for sectioning or containment. Boundaries must be defined solely through background color shifts. 
- A card should never have a border; it should be a `surface_container_lowest` element sitting on a `surface_container_low` background. 
- Sections are separated by vertical space or a change from `surface` to `surface_variant`.

### Surface Hierarchy & Nesting
Treat the UI as a series of physical layers. We use the "Tonal Nesting" method:
1.  **Base Layer:** `surface` (#f0ffd8) - The canvas.
2.  **Section Layer:** `surface_container_low` (#e8facd) - Defines broad content areas.
3.  **Content Layer:** `surface_container_lowest` (#ffffff) - High-priority interaction cards.

### Signature Textures & Glassmorphism
To avoid a "flat" feel, main CTAs should use a subtle linear gradient from `primary` (#9b4500) to `primary_container` (#f97f2d). 
- **The Sidebar:** Utilize `inverse_surface` (#273517) with a 15% opacity backdrop-blur (Glassmorphism) when overlaying content, allowing the organic greens of the background to bleed through, softening the interface.

---

## 3. Typography: Editorial Authority

We use a dual-font strategy to balance character with legibility.

*   **Display & Headlines:** *Plus Jakarta Sans*. This is our "Editorial" voice. It features a modern, slightly geometric construction that feels premium.
    *   *display-lg/md:* Use for hero numbers (e.g., total inventory value).
    *   *headline-sm:* Use for card titles to provide a bold, authoritative anchor.
*   **Body & Utility:** *Inter*. Our "Workhorse" font. Chosen for its exceptional readability at small sizes in dense data tables or management lists.
    *   *label-md:* Used for secondary data points, always with increased letter-spacing (approx +2%) to maintain an upscale feel.

---

## 4. Elevation & Depth: Tonal Layering

Traditional drop shadows are often a crutch for poor layout. In this system, we achieve depth through **Layering Principles.**

*   **Ambient Shadows:** When a "floating" effect is required for a modal or a primary action button, use an extra-diffused shadow.
    *   *Spec:* `0px 20px 40px rgba(18, 31, 5, 0.06)` (A tint of `on_surface`). This mimics natural, soft ambient light rather than a digital drop shadow.
*   **The Ghost Border Fallback:** If a layout requires a boundary for accessibility (e.g., in high-density data views), use a **Ghost Border**.
    *   *Spec:* 1px solid `outline_variant` (#dec1b2) at 15% opacity. It should be felt, not seen.
*   **Glassmorphism:** For mobile navigation and floating headers, use semi-transparent `surface_container_highest` with a `blur(20px)` to keep the user grounded in their current context.

---

## 5. Component Logic

### Sidebar & Navigation
- **Background:** `inverse_surface` (#273517).
- **Active State:** Instead of a simple box, use a "pill" shape (`rounded-full`) in `primary_container` (#f97f2d) for the icon, while the text remains high-contrast white. This creates a "signature" focal point.

### Buttons (The "Tactile" CTA)
- **Primary:** `primary_container` (#f97f2d) with `on_primary_container` (#5f2700) text. 
- **Shape:** 12px (`xl` or `lg` scale) rounded corners. 
- **Interaction:** On hover, apply a subtle scale-up (1.02x) and transition to the `primary` gradient.

### Input Fields
- Avoid white backgrounds for inputs. Use `surface_container` (#e2f4c8) to make them feel "recessed" into the interface. 
- **Focus State:** 2px "Ghost Border" using `tertiary` (#006e16) to signal a "positive/active" food-management state.

### Cards & Lists
- **The "No-Divider" Rule:** Forbid 1px horizontal lines between list items. Use 16px or 24px of vertical whitespace. If separation is critical, use a 2px-high bar of `surface_container_high` that doesn't span the full width of the card.

### Additional Signature Component: The "Freshness Badge"
A bespoke component for this system. A pill-shaped badge using `tertiary_container` (#4cb64b) for positive status (e.g., "In Stock") and `error_container` (#ffdad6) for critical status. It uses `label-sm` in all caps to denote urgency with elegance.

---

## 6. Do’s and Don’ts

### Do:
- **Use Asymmetric Whitespace:** Allow a "Hero" card to take up 65% of the width, leaving the remaining 35% for secondary "Glanceable" stats to create a sophisticated editorial rhythm.
- **Color-Code Intentionally:** Use `tertiary` (Green) for organic/positive growth and `primary` (Orange) for human-driven actions and alerts.
- **Layer Surfaces:** Place a `surface_container_lowest` card inside a `surface_container_low` section.

### Don’t:
- **Don’t use "Pure Black" (#000000):** Use `on_surface` (#121f05) for all text to keep the organic, high-end feel.
- **Don’t use Sharp Corners:** Nothing in this system should have a corner radius smaller than 8px (`md`). Food management is organic; the UI should reflect that softness.
- **Don’t Over-Shadow:** If you have three layers of depth, only the topmost layer (e.g., a Modal) should have an ambient shadow. Lower layers rely on tonal shifts.
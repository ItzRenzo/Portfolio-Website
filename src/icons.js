const baseAttrs = 'viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"';

export const icons = {
    arrow: `<svg ${baseAttrs}><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>`,
    check: `<svg ${baseAttrs}><path d="m20 6-11 11-5-5"/></svg>`,
    code: `<svg ${baseAttrs}><path d="m16 18 6-6-6-6"/><path d="m8 6-6 6 6 6"/><path d="m14.5 4-5 16"/></svg>`,
    discord: `<svg ${baseAttrs}><path d="M8 9.5a7 7 0 0 1 8 0"/><path d="M9 15h.01"/><path d="M15 15h.01"/><path d="M7.5 18.5c3 1.5 6 1.5 9 0"/><path d="M5.5 7.5C7.2 6.7 8.7 6.2 10 6l.6 1.2"/><path d="M18.5 7.5C16.8 6.7 15.3 6.2 14 6l-.6 1.2"/><path d="M4 8c-1.2 3-1.5 6.4-.8 10.2 1.8 1.3 3.6 2.2 5.4 2.7l1.1-1.8"/><path d="M20 8c1.2 3 1.5 6.4.8 10.2-1.8 1.3-3.6 2.2-5.4 2.7l-1.1-1.8"/></svg>`,
    external: `<svg ${baseAttrs}><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>`,
    github: `<svg ${baseAttrs}><path d="M15 22v-3.2a3 3 0 0 0-.8-2.4c2.7-.3 5.6-1.3 5.6-6A4.7 4.7 0 0 0 18.5 7c.1-.3.6-1.7-.1-3.4 0 0-1.1-.3-3.5 1.3a12.2 12.2 0 0 0-6.4 0C6.1 3.3 5 3.6 5 3.6 4.3 5.3 4.8 6.7 4.9 7a4.7 4.7 0 0 0-1.3 3.4c0 4.7 2.9 5.7 5.6 6a3 3 0 0 0-.8 2.3V22"/><path d="M9 19c-3 .9-3-1.5-4.2-1.8"/></svg>`,
    image: `<svg ${baseAttrs}><rect width="18" height="18" x="3" y="3" rx="2"/><path d="m21 15-5-5L5 21"/><path d="M8.5 8.5h.01"/></svg>`,
    layout: `<svg ${baseAttrs}><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>`,
    package: `<svg ${baseAttrs}><path d="m21 8-9-5-9 5 9 5 9-5Z"/><path d="M3 8v8l9 5 9-5V8"/><path d="M12 13v8"/></svg>`,
    server: `<svg ${baseAttrs}><rect width="18" height="8" x="3" y="4" rx="2"/><rect width="18" height="8" x="3" y="12" rx="2"/><path d="M7 8h.01"/><path d="M7 16h.01"/></svg>`,
    shield: `<svg ${baseAttrs}><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg>`,
    store: `<svg ${baseAttrs}><path d="m2 7 2-4h16l2 4"/><path d="M4 7v13h16V7"/><path d="M9 20v-7h6v7"/><path d="M2 7h20"/></svg>`,
    youtube: `<svg ${baseAttrs}><path d="M2.5 12s0-3.4.4-5a3 3 0 0 1 2.1-2.1C6.6 4.5 12 4.5 12 4.5s5.4 0 7 .4A3 3 0 0 1 21.1 7c.4 1.6.4 5 .4 5s0 3.4-.4 5a3 3 0 0 1-2.1 2.1c-1.6.4-7 .4-7 .4s-5.4 0-7-.4A3 3 0 0 1 2.9 17c-.4-1.6-.4-5-.4-5Z"/><path d="m10 9 5 3-5 3V9Z"/></svg>`
};

export function icon(name) {
    return icons[name] ?? icons.package;
}

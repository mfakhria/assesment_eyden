import { Menu } from 'lucide-react';
import { motion } from 'framer-motion';
import React from 'react';
import { getContent } from '../../lib/content';

const navLinks = [
    { labelKey: 'nav_home', href: '#', active: true },
    { labelKey: 'nav_tours', href: '#' },
    { labelKey: 'nav_reviews', href: '#' },
    { labelKey: 'nav_contact', href: '/cms', button: true },
];

export default function Navbar() {
    return (
        <motion.nav className="flex items-center justify-between" initial={{ opacity: 0, y: -18 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.55 }}>
            <a className="flex items-center gap-1 text-2xl font-extrabold tracking-tight sm:text-3xl" href="/">
                <span className="grid h-8 w-8 place-items-center rounded-full bg-orange-400 text-white">T</span>
                <span>{getContent('brand_name', 'Travel')}</span>
            </a>

            <div className="hidden items-center gap-9 text-sm font-bold md:flex">
                {navLinks.map((link) => (
                    <a className={`${link.active ? 'active-nav' : ''} ${link.button ? 'rounded-full border-2 border-slate-900 px-6 py-3' : ''}`} href={link.href} key={link.labelKey}>
                        {getContent(link.labelKey)}
                    </a>
                ))}
            </div>

            <a className="grid h-11 w-11 place-items-center rounded-full border border-slate-200 bg-white/80 text-slate-900 shadow-sm md:hidden" href="/cms" aria-label="Open CMS menu">
                <Menu className="h-5 w-5" />
            </a>
        </motion.nav>
    );
}

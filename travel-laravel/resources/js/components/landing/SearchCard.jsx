import { CalendarDaysIcon, MapPinIcon } from '@heroicons/react/24/outline';
import { Search } from 'lucide-react';
import { motion } from 'framer-motion';
import React from 'react';
import { smoothEase } from '../../lib/animations';
import { getContent } from '../../lib/content';

const searchItems = [
    { label: 'Location', contentKey: 'location', icon: MapPinIcon },
    { label: 'Date', contentKey: 'date', icon: CalendarDaysIcon },
    { label: 'Return', contentKey: 'return_date', icon: CalendarDaysIcon },
];

export default function SearchCard() {
    return (
        <motion.form
            className="relative z-30 mt-8 flex max-w-[640px] flex-col rounded-[2rem] bg-white p-5 shadow-2xl shadow-slate-200/80 md:flex-row md:items-center md:rounded-full md:p-3 lg:w-[640px]"
            initial={{ opacity: 0, y: 34, scale: 0.96 }}
            animate={{ opacity: 1, y: 0, scale: 1 }}
            transition={{ duration: 0.72, delay: 0.25, ease: smoothEase }}
        >
            {searchItems.map((item, index) => (
                <div className={`search-item ${index === 1 ? 'md:border-x md:border-slate-200' : ''}`} key={item.label}>
                    <item.icon className="h-6 w-6 shrink-0 text-orange-400" />
                    <div className="min-w-0">
                        <p>{item.label}<span className="text-yellow-400">⌄</span></p>
                        <strong>{getContent(item.contentKey)}</strong>
                    </div>
                </div>
            ))}

            <button className="mx-auto mt-2 grid h-16 w-16 shrink-0 place-items-center rounded-full bg-orange-400 text-white shadow-lg shadow-orange-200 transition hover:scale-105 md:mt-0" type="button">
                <Search className="h-7 w-7" />
            </button>
        </motion.form>
    );
}

import { motion } from 'framer-motion';
import React from 'react';
import { fadeUp, staggerChildren } from '../../lib/animations';
import { getContent } from '../../lib/content';

const values = [
    { icon: '/assets/images/earth.svg', alt: 'earth icon', titleKey: 'choice_title', textKey: 'choice_text' },
    { icon: '/assets/images/suitcase.svg', alt: 'suitcase icon', titleKey: 'guide_title', textKey: 'guide_text' },
    { icon: '/assets/images/ticket.svg', alt: 'ticket icon', titleKey: 'booking_title', textKey: 'booking_text' },
];

export default function ValueSection() {
    return (
        <motion.section className="grid gap-9 pb-10 pt-16 md:grid-cols-4 md:pt-20" initial="hidden" whileInView="show" viewport={{ once: true, amount: 0.25 }} variants={staggerChildren(0.14)}>
            <motion.div variants={fadeUp}>
                <p className="text-sm font-extrabold uppercase text-orange-400">{getContent('values_label')}</p>
                <h2 className="mt-3 text-4xl font-extrabold leading-tight text-[#05113f]">{getContent('values_title')}</h2>
                <p className="mt-6 text-slate-500">{getContent('values_text')}</p>
            </motion.div>

            {values.map((item) => (
                <motion.article className="value-card" variants={fadeUp} key={item.titleKey}>
                    <div><img className="h-16 w-16 object-contain" src={item.icon} alt={item.alt} /></div>
                    <h3>{getContent(item.titleKey)}</h3>
                    <p>{getContent(item.textKey)}</p>
                </motion.article>
            ))}
        </motion.section>
    );
}

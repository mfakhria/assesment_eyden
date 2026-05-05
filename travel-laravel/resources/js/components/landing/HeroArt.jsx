import { MapPinIcon } from '@heroicons/react/24/outline';
import { motion } from 'framer-motion';
import { Mountain, ShipWheel, TicketCheck } from 'lucide-react';
import React from 'react';
import { fadeUp } from '../../lib/animations';
import { getContent } from '../../lib/content';
import FloatingBubble from './FloatingBubble';

export default function HeroArt() {
    return (
        <motion.div className="relative mx-auto min-h-[390px] w-full max-w-[360px] sm:min-h-[440px] sm:max-w-[440px] lg:min-h-[500px] lg:max-w-none" initial="hidden" animate="show" variants={fadeUp}>
            <motion.img
                animate={{ y: [0, -10, 0] }}
                className="absolute left-8 top-0 z-20 h-[330px] w-[235px] rounded-t-full rounded-b-[9rem] border-[7px] border-white object-cover shadow-xl sm:left-16 sm:h-[380px] sm:w-[270px] lg:left-auto lg:right-32 lg:h-[420px] lg:w-[300px] lg:rounded-b-[12rem] lg:border-8"
                src={getContent('main_image')}
                alt="traveler"
                transition={{ duration: 5, ease: 'easeInOut', repeat: Infinity }}
            />
            <motion.img
                animate={{ y: [0, 12, 0] }}
                className="absolute bottom-0 right-3 z-10 h-[235px] w-[145px] rounded-t-full rounded-b-[6rem] border-[7px] border-white object-cover shadow-xl sm:right-5 sm:h-[275px] sm:w-[168px] lg:right-0 lg:h-[300px] lg:w-[182px] lg:rounded-b-[8rem] lg:border-8"
                src={getContent('side_image')}
                alt="mountain"
                transition={{ duration: 5.5, ease: 'easeInOut', repeat: Infinity }}
            />

            <FloatingBubble className="left-0 top-7 scale-75 sm:scale-90 lg:left-4 lg:top-10 lg:scale-100" delay={0.1}><ShipWheel className="h-9 w-9 text-sky-500" /></FloatingBubble>
            <FloatingBubble className="right-1 top-12 scale-75 sm:scale-90 lg:right-2 lg:top-16 lg:scale-100" delay={0.4}><Mountain className="h-9 w-9 text-emerald-500" /></FloatingBubble>
            <FloatingBubble className="bottom-16 right-8 scale-75 sm:bottom-20 sm:right-12 sm:scale-90 lg:bottom-24 lg:right-16 lg:scale-100" delay={0.7}><TicketCheck className="h-9 w-9 text-orange-400" /></FloatingBubble>

            <svg className="pointer-events-none absolute right-12 -top-4 z-30 h-28 w-28 overflow-visible sm:right-20 sm:h-32 sm:w-32 lg:right-20 lg:h-36 lg:w-36" fill="none" viewBox="0 0 150 150" aria-hidden="true">
                <motion.path
                    d="M62 4 C55 42 70 70 101 96"
                    stroke="#1f2945"
                    strokeDasharray="1 11"
                    strokeLinecap="round"
                    strokeWidth="3"
                    initial={{ pathLength: 0, opacity: 0 }}
                    animate={{ pathLength: 1, opacity: 0.7 }}
                    transition={{ duration: 1.35, delay: 0.7, ease: 'easeInOut' }}
                />
            </svg>

            <motion.span className="absolute right-14 -top-8 z-30 text-slate-800 sm:right-20 lg:right-24 lg:-top-10" animate={{ y: [0, -8, 0] }} transition={{ duration: 3.8, repeat: Infinity }}>
                <MapPinIcon className="h-10 w-10 sm:h-12 sm:w-12" />
            </motion.span>
        </motion.div>
    );
}

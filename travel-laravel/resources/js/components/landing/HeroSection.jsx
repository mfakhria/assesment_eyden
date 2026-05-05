import { motion } from 'framer-motion';
import { Camera } from 'lucide-react';
import React from 'react';
import { fadeUp, staggerChildren } from '../../lib/animations';
import { getContent } from '../../lib/content';
import HeroArt from './HeroArt';
import SearchCard from './SearchCard';

const titleLines = [
    { text: 'Life is short' },
    { text: 'and the world', emoji: '🌍' },
    { text: 'is Wide!', emoji: '🏝️' },
];

export default function HeroSection() {
    return (
        <div className="grid items-center gap-10 pt-12 sm:pt-14 lg:grid-cols-[560px_1fr] lg:gap-4 lg:pt-16">
            <motion.div className="hero-copy relative z-20" initial="hidden" animate="show" variants={staggerChildren()}>
                <motion.p className="hero-eyebrow" variants={fadeUp}>{getContent('eyebrow')}</motion.p>
                <motion.h1 className="hero-title" variants={fadeUp} aria-label={getContent('hero_title')}>
                    {titleLines.map((line) => (
                        <span className="hero-title-line" key={line.text}>
                            {line.text}
                            {line.emoji ? <span className="hero-title-emoji" aria-hidden="true">{line.emoji}</span> : null}
                        </span>
                    ))}
                </motion.h1>
                <motion.span className="pointer-events-none absolute right-3 top-16 hidden text-slate-700 lg:block xl:-right-1" animate={{ y: [0, -8, 0], rotate: [0, 5, 0] }} transition={{ duration: 4, repeat: Infinity }}>
                    <Camera className="h-11 w-11" />
                </motion.span>
                <SearchCard />
            </motion.div>

            <HeroArt />
        </div>
    );
}

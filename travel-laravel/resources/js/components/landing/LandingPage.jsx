import { motion, useScroll, useTransform } from 'framer-motion';
import React from 'react';
import { getContent } from '../../lib/content';
import DecorativeTrails from './DecorativeTrails';
import HeroSection from './HeroSection';
import Navbar from './Navbar';
import ValueSection from './ValueSection';

export default function LandingPage() {
    const { scrollYProgress } = useScroll();
    const pathX = useTransform(scrollYProgress, [0, 1], [0, 70]);

    return (
        <main className="relative min-h-screen overflow-hidden bg-[radial-gradient(circle_at_12%_15%,#e8edff_0,transparent_32%),radial-gradient(circle_at_88%_24%,#fff0fb_0,transparent_36%),linear-gradient(135deg,#f8fbff_0%,#fffafd_100%)]">
            <DecorativeTrails />
            <motion.img className="pointer-events-none absolute left-0 top-[55%] z-10 hidden w-36 opacity-70 sm:block" src={getContent('plane_icon')} alt="plane trail" style={{ x: pathX }} />

            <section className="relative z-10 mx-auto max-w-6xl px-5 py-7 sm:px-6 sm:py-10 lg:px-8">
                <Navbar />
                <HeroSection />
                <ValueSection />
            </section>
        </main>
    );
}

import { motion } from 'framer-motion';
import React from 'react';

const routes = [
    {
        d: 'M338 218 C410 234 475 187 517 152',
        stroke: '#1f2945',
        dash: '2 12',
        width: 2.4,
        opacity: 0.58,
        duration: 1.5,
        delay: 0.35,
    },
    {
        d: 'M315 474 C438 285 610 220 798 205 C945 194 1040 166 1150 94',
        stroke: '#9aa3b8',
        dash: '2 15',
        width: 2.4,
        opacity: 0.42,
        duration: 2.25,
        delay: 0.5,
    },
    {
        d: 'M0 500 C50 528 105 502 145 452',
        stroke: '#f58ab8',
        dash: '2 13',
        width: 2.4,
        opacity: 0.58,
        duration: 1.55,
        delay: 0.65,
        plane: { x: 106, y: 474, rotate: -35 },
    },
    {
        d: 'M832 178 C864 103 924 100 948 138',
        stroke: '#1f2945',
        dash: '2 12',
        width: 2.4,
        opacity: 0.68,
        duration: 1.35,
        delay: 0.75,
    },
];

function PlaneMarker({ plane }) {
    if (!plane) return null;

    return (
        <motion.g
            initial={{ opacity: 0, scale: 0.7 }}
            animate={{ opacity: 1, scale: 1 }}
            transition={{ duration: 0.4, delay: 1.25, ease: 'easeOut' }}
            transform={`translate(${plane.x} ${plane.y}) rotate(${plane.rotate})`}
        >
            <path d="M-17 2 L18 -8 L7 4 L12 16 L0 8 L-10 15 L-5 5 Z" fill="#f58ab8" />
        </motion.g>
    );
}

export default function DecorativeTrails() {
    return (
        <svg className="pointer-events-none absolute inset-0 z-0 h-full w-full overflow-visible" fill="none" viewBox="0 0 1152 620" aria-hidden="true">
            {routes.map((route) => (
                <g key={route.d}>
                    <motion.path
                        d={route.d}
                        stroke={route.stroke}
                        strokeDasharray={route.dash}
                        strokeLinecap="round"
                        strokeWidth={route.width}
                        initial={{ pathLength: 0, opacity: 0 }}
                        animate={{ pathLength: 1, opacity: route.opacity }}
                        transition={{ duration: route.duration, delay: route.delay, ease: 'easeInOut' }}
                    />
                    <PlaneMarker plane={route.plane} />
                </g>
            ))}
        </svg>
    );
}

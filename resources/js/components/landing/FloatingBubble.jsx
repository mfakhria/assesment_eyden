import { motion } from 'framer-motion';
import React from 'react';

export default function FloatingBubble({ children, className = '', delay = 0 }) {
    return (
        <motion.span
            animate={{ y: [0, -12, 0], rotate: [0, 4, -3, 0] }}
            className={`float-icon ${className}`}
            transition={{ duration: 4.2, delay, ease: 'easeInOut', repeat: Infinity }}
        >
            {children}
        </motion.span>
    );
}

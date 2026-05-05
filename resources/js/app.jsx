import './bootstrap';
import '../css/app.css';

import React from 'react';
import { createRoot } from 'react-dom/client';
import LandingPage from './components/landing/LandingPage';

const root = document.getElementById('landing-root');

if (root) {
    createRoot(root).render(<LandingPage />);
}

import { load } from 'piecesjs';

import '@agencecinq/drawer';

load('cinq-accordion', () => import('@agencecinq/accordion'));
load('cinq-modal', () => import('@agencecinq/modal'));
load('cinq-slideshow', () => import('./components/Slideshow.ts'));
load('cinq-mobile-menu', () => import('./components/MobileMenu.ts'));

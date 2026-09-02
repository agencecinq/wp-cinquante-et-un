import { load } from 'piecesjs';

import '@agencecinq/accordion';
import '@agencecinq/drawer';
import '@agencecinq/modal';

load('cinq-slideshow', () => import('./components/Slideshow.ts'));
load('cinq-mobile-menu', () => import('./components/MobileMenu.ts'));
load('cinq-toc', () => import('./components/Toc.ts'));

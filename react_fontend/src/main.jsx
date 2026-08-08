import { StrictMode } from 'react';
import { createRoot } from 'react-dom/client';
import App from './App.jsx';
import { PrimeReactProvider } from '@primereact/core';
// import Aura from '@primeuix/themes/aura';import "primereact/resources/themes/lara-light-blue/theme.css";
// import "primereact/resources/primereact.min.css";
import Aura from '@primeuix/themes/aura';
import "primeicons/primeicons.css";
import "primeflex/primeflex.css";
import './index.css';

const primereact = {
    theme: {
        preset: Aura
    },
    license: 'PrimeUI-Commercial-Key...'
};

createRoot(document.getElementById('root')).render(
    <StrictMode>
        <PrimeReactProvider {...primereact}>
            <App />
        </PrimeReactProvider>
    </StrictMode>
);

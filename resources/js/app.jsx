import React from 'react';
import ReactDOM from 'react-dom/client';
import InstagramPost from './components/instagram';

document.querySelectorAll("[data-instagram-url]").forEach((el) => {
  const url = el.dataset.instagramUrl;
  if (url) {
    ReactDOM.createRoot(el).render(
      <React.StrictMode>
        <InstagramPost url={url} width={400} />
      </React.StrictMode>
    );
  }
});



import React from 'react';
import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import HelloPage from "./components/HelloPage";

function Main() {
  return (
    <Router>
      <Routes>
        <Route exact path="/"  element={<HelloPage/>} />
      </Routes>
    </Router>
  );
}

export default Main;

if (document.getElementById('app')) {
  const rootElement = document.getElementById("app");
  const root = createRoot(rootElement);

  root.render(
    <StrictMode>
      <Main />
    </StrictMode>
  );
}
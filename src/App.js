import React from 'react';
import './App.css';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import MainPage from './components/MainPage';
import Create from './components/create';
import ReadAll from './components/readAll';
import ReadOne from './components/readOne';
import Update from './components/update';
import Delete from './components/delete';

function App() {
  return (
    <Router>
      <div className="app-container">
        <nav className="nav">
          <h1>Bookmark Manager</h1>
          <a href="/">Home</a>
        </nav>
        <div className="content-container">
          <Routes>
            <Route path="/" element={<MainPage />} />
            <Route path="/create" element={<Create />} />
            <Route path="/read-all" element={<ReadAll />} />
            <Route path="/read-one" element={<ReadOne />} />
            <Route path="/update" element={<Update />} />
            <Route path="/delete" element={<Delete />} />
          </Routes>
        </div>
      </div>
    </Router>
  );
}

export default App;

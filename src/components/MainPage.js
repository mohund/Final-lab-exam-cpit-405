import React from 'react';
import { useNavigate } from 'react-router-dom';
import './MainPage.css';

function MainPage() {
  const navigate = useNavigate();

  return (
    <div className="main-container">
      <div className="button-container">
        <button onClick={() => navigate('/create')}>Create Bookmark</button>
        <button onClick={() => navigate('/read-all')}>View All Bookmarks</button>
        <button onClick={() => navigate('/read-one')}>Search Bookmark</button>
        <button onClick={() => navigate('/update')}>Update Bookmark</button>
        <button onClick={() => navigate('/delete')}>Delete Bookmark</button>
      </div>
    </div>
  );
}

export default MainPage;

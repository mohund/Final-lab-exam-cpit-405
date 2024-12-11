import React, { useState } from 'react';
import './readOne.css';

const apiUrl = 'http://localhost:3000/api';

function ReadOne() {
  const [id, setId] = useState('');
  const [bookmark, setBookmark] = useState(null);

  const fetchBookmark = async () => {
    try {
      const response = await fetch(`${apiUrl}/readOne.php?id=${id}`);
      const data = await response.json();
      setBookmark(data);
    } catch (error) {
      console.error('Error fetching bookmark:', error);
    }
  };

  return (
    <div className="readOne-container">
      <h2>Search for a Bookmark</h2>
      <input
        type="text"
        placeholder="Enter Bookmark ID"
        value={id}
        onChange={(e) => setId(e.target.value)}
      />
      <button onClick={fetchBookmark}>Search</button>
      {bookmark && (
        <div className="bookmark-details">
          <a href={bookmark.link} target="_blank" rel="noopener noreferrer">
          <h3>{bookmark.title}</h3>
          </a>
        </div>
      )}
    </div>
  );
}

export default ReadOne;

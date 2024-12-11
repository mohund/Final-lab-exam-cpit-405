import React, { useEffect, useState } from 'react';
import './readAll.css';

const apiUrl = 'http://localhost:3000/api';

function ReadAll() {
  const [bookmarks, setBookmarks] = useState([]);

  useEffect(() => {
    const fetchBookmarks = async () => {
      try {
        const response = await fetch(`${apiUrl}/readAll.php`);
        const data = await response.json();
        setBookmarks(data);
      } catch (error) {
        console.error('Error fetching bookmarks:', error);
      }
    };

    fetchBookmarks();
  }, []);

  return (
    <div className="readAll-container">
      <h2>All Bookmarks</h2>
      <ul>
        {bookmarks.map((bookmark) => (
          <li key={bookmark.id}>
            <a href={bookmark.link} target="_blank" rel="noopener noreferrer">
           <span > ID : {bookmark.id}   Title :</span>{bookmark.title}
            </a>
          </li>
        ))}
      </ul>
    </div>
  );
}

export default ReadAll;

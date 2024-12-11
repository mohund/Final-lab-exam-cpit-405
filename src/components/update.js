import React, { useState } from 'react';
import './update.css';

const apiUrl = 'http://localhost:3000/api';

function Update() {
  const [id, setId] = useState('');
  const [title, setTitle] = useState('');
  const [link, setLink] = useState('');

  const handleUpdate = async (e) => {
    e.preventDefault();
    if (id && title.trim() && link.trim()) {
      try {
        const options = {
          method: 'PUT',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ id, title, link }),
        };
        await fetch(`${apiUrl}/update.php`, options);
        alert('Bookmark updated successfully!');
      } catch (error) {
        console.error('Error updating bookmark:', error);
      }
    }
  };

  return (
    <div className="update-container">
      <h2>Update a Bookmark</h2>
      <form onSubmit={handleUpdate}>
        <input
          type="text"
          placeholder="Enter Bookmark ID"
          value={id}
          onChange={(e) => setId(e.target.value)}
        />
        <input
          type="text"
          placeholder="Enter New Title"
          value={title}
          onChange={(e) => setTitle(e.target.value)}
        />
        <input
          type="url"
          placeholder="Enter New URL"
          value={link}
          onChange={(e) => setLink(e.target.value)}
        />
        <button type="submit">Update Bookmark</button>
      </form>
    </div>
  );
}

export default Update;

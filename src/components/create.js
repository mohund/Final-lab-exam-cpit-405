import React, { useState } from 'react';
import './create.css';
const apiUrl = 'http://localhost:3000/api';

function Create() {
  const [title, setTitle] = useState('');
  const [link, setLink] = useState(''); // تغيير من url إلى link

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (title.trim() && link.trim()) {
      try {
        const options = {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ title, link }), // تغيير من url إلى link
        };
        const response = await fetch(`${apiUrl}/create.php`, options);

        if (response.ok) {
          alert('Bookmark created successfully!');
          setTitle('');
          setLink('');
        } else {
          const errorData = await response.json();
          alert(`Error: ${errorData.message}`);
        }
      } catch (error) {
        console.error('Error creating bookmark:', error);
        alert('An error occurred while creating the bookmark.');
      }
    } else {
      alert('Please fill in all fields.');
    }
  };

  return (
    <div className="create-container">
      <h2>Create a New Bookmark</h2>
      <form onSubmit={handleSubmit}>
        <input
          type="text"
          placeholder="Enter Title"
          value={title}
          onChange={(e) => setTitle(e.target.value)}
        />
        <input
          type="url"
          placeholder="Enter URL"
          value={link}
          onChange={(e) => setLink(e.target.value)} // تغيير من url إلى link
        />
        <button type="submit">Add Bookmark</button>
      </form>
      
        </div>
  );
}

export default Create;

import React, { useState } from 'react';
import './delete.css';
import ReadAll from './readAll';
const apiUrl = 'http://localhost:3000/api';

function Delete() {
  const [id, setId] = useState('');

  const handleDelete = async () => {
    try {
      const options = {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id }),
      };
      await fetch(`${apiUrl}/delete.php`, options);
      alert('Bookmark deleted successfully!');
    } catch (error) {
      console.error('Error deleting bookmark:', error);
    }
  };

  return (
    <div className="delete-container">
      <h2>Delete a Bookmark</h2>
      <input
        type="text"
        placeholder="Enter Bookmark ID"
        value={id}
        onChange={(e) => setId(e.target.value)}
      />
      <br />
      <button onClick={handleDelete}>Delete Bookmark</button>

      <ReadAll/>
    </div>
  );
}

export default Delete;

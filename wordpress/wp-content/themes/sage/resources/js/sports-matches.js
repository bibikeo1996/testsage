// Sports Matches JavaScript
document.addEventListener('DOMContentLoaded', function() {
  // Tab switching functionality
  const tabs = document.querySelectorAll('.tab');
  const tabContents = document.querySelectorAll('.tab-content');

  tabs.forEach(tab => {
    tab.addEventListener('click', function() {
      const targetTab = this.getAttribute('data-tab');
      
      // Remove active class from all tabs and contents
      tabs.forEach(t => t.classList.remove('active'));
      tabContents.forEach(content => content.classList.remove('active'));
      
      // Add active class to clicked tab and corresponding content
      this.classList.add('active');
      document.getElementById(`tab-${targetTab}`).classList.add('active');
    });
  });

  // Star icon functionality
  const starIcons = document.querySelectorAll('.star-icon');
  starIcons.forEach(star => {
    star.addEventListener('click', function() {
      this.classList.toggle('favorite');
      if (this.classList.contains('favorite')) {
        this.style.color = '#ffd700';
      } else {
        this.style.color = '#ccc';
      }
    });
  });

  // Update live matches count
  function updateLiveCount() {
    const liveMatches = document.querySelectorAll('.match-status.live');
    const liveCountElement = document.getElementById('live-count');
    if (liveCountElement) {
      liveCountElement.textContent = liveMatches.length;
    }
  }

  // Update match times and statuses
  function updateMatchStatuses() {
    const matchRows = document.querySelectorAll('.match-row');
    matchRows.forEach(row => {
      const statusElement = row.querySelector('.match-status');
      if (statusElement && statusElement.classList.contains('live')) {
        // Simulate live match updates
        const currentText = statusElement.textContent;
        if (currentText.includes("'")) {
          const minute = parseInt(currentText.replace("'", ""));
          if (minute < 90) {
            statusElement.textContent = (minute + 1) + "'";
          } else {
            statusElement.textContent = "Kết thúc";
            statusElement.classList.remove('live');
            statusElement.classList.add('finished');
          }
        }
      }
    });
    updateLiveCount();
  }

  // Update every 30 seconds
  setInterval(updateMatchStatuses, 30000);
  
  // Initial update
  updateLiveCount();
  updateMatchStatuses();
}); 
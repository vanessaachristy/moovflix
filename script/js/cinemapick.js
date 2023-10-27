document.addEventListener("DOMContentLoaded", function() {
    function fetchCinemas() {
        fetch('script/php/get_cinemas.php')
            .then(response => response.json())
            .then(data => {
                updateCinemaList(data); 
            })
            .catch(error => console.error('Error fetching cinemas:', error));
    }

    function updateCinemaList(cinemas) {
        const cinemaListContainer = document.getElementById('cinema-list-container');

        cinemaListContainer.innerHTML = '';

        let currentCinemaRow = null;

        cinemas.forEach((screen, index) => {
            if (index % 3 === 0) {
                currentCinemaRow = document.createElement('div');
                currentCinemaRow.classList.add('movie-row');
            }

            const cinemaElement = document.createElement('div');
            cinemaElement.classList.add('movie-name', 'cinema-name');

            cinemaElement.innerHTML = `
                <img src="${screen.images}" class="movie-pic cinema-pic">
                <h2>${screen.cinema_name}</h2>
                <div class="cinema-location">
                    <img src="img/location.png" class="location-icon"><h3>${screen.cinema_location}</h3>
                </div>
                <input type="button" class="showtimes" value="Showtimes" data-cinema-id="${screen.id}">
            `;

            cinemaElement.querySelector('.showtimes').addEventListener('click', (event) => {
                const cinemaId = event.currentTarget.getAttribute('data-cinema-id');
                const url = `cinemadetails.html?id=${cinemaId}`;
                window.location.href = url;
            });

            currentCinemaRow.appendChild(cinemaElement);

            if ((index % 3 === 2) || (index === cinemas.length - 1)) {
                cinemaListContainer.appendChild(currentCinemaRow);
            }
        });
    }

    fetchCinemas();
});

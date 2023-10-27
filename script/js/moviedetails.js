document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const movieId = urlParams.get("id");

    function fetchMovieDetails(movieId) {
        fetch(`script/php/get_movies_details.php?id=${movieId}`)
            .then(response => response.json())
            .then(data => {
                updateMovieDetails(data); 
            })
            .catch(error => console.error('Error fetching movies:', error));
    }

    function updateMovieDetails(movieDetails){
        const title = document.getElementById('movie-title');
        const genre = document.getElementById('movie-genre');
        const language = document.getElementById('movie-language');
        const duration = document.getElementById('movie-duration');
        const poster = document.getElementById('movie-poster'); 
        const rating = document.getElementById('movie-rating'); 
        const director = document.getElementById('movie-director'); 
        const cast = document.getElementById('movie-cast'); 
        const synopsis = document.getElementById('movie-synopsis'); 

        title.textContent = movieDetails.movie_name; 
        genre.textContent = movieDetails.genre; 
        language.textContent = movieDetails.languages; 
        duration.textContent = movieDetails.duration; 
        poster.src = movieDetails.poster; 
        rating.textContent = movieDetails.rating; 
        director.textContent = movieDetails.director; 
        cast.textContent = movieDetails.cast; 
        synopsis.textContent = movieDetails.synopsis; 
    }

    function fetchCinemas() {
        fetch('script/php/get_cinemas.php')
            .then(response => response.json())
            .then(data => {
                updateCinemaCarouselList(data); 
            })
            .catch(error => console.error('Error fetching cinemas:', error));
    }

    function updateCinemaCarouselList(cinemas) {
        const movieCarouselContainer = document.getElementById('movie-carousel-container');

        movieCarouselContainer.innerHTML = '';

        let currentCinemaBox = null;

        cinemas.forEach((screen, index) => {
            
            currentCinemaBox = document.createElement('div');
            currentCinemaBox.classList.add('cinema-box');

            const cinemaLocationName = document.createElement('div'); 
            cinemaLocationName.classList.add('cinema-location-name'); 

            cinemaLocationName.innerHTML = `<img src="img/location.png" class="location-name-icon"><h2 id="cinema-name">${screen.cinema_name}</h2>`; 
            currentCinemaBox.appendChild(cinemaLocationName);

            const dateCarousel = document.createElement('div');
            dateCarousel.classList.add('date-carousel');
            dateCarousel.id = 'date-carousel-' + (index + 1);

            dateCarousel.innerHTML = `
            <a href="#" id="prevDate" role="button"><img class="next-arrow" src="img/left-arrow.svg" alt=""></a>
            <a href="#" role="button" class="date-items"><h3>Friday, 20 October</h3></a>
            <a href="#" role="button" class="date-items"><h3>Saturday, 21 October</h3></a>
            <a href="#" role="button"class="date-items"><h3>Sunday, 22 October</h3></a>
            <a href="#" role="button"class="date-items"><h3>Monday, 23 October</h3></a>
            <a href="#" role="button"class="date-items"><h3>Thursday, 24 October</h3></a>
            <a href="#" id="nextDate" role="button"><img class="next-arrow next-arrow-right" src="img/arrow-right.svg" alt=""></a>
            `;

            const cinemaTime = document.createElement('div'); 
            cinemaTime.classList.add('cinema-time-list'); 

            cinemaTime.innerHTML = `
                    <input type="button" class="cinema-time" value="xx:xx">
                    <input type="button" class="cinema-time" value="xx:xx">
                    <input type="button" class="cinema-time" value="xx:xx">
            `;
    
            currentCinemaBox.appendChild(dateCarousel);
            currentCinemaBox.appendChild(cinemaTime);
    
            movieCarouselContainer.appendChild(currentCinemaBox);

            setupDateCarousel(currentCinemaBox.querySelector('.date-carousel'), index + 1);

        });
    }

    function updateDates(carousel, currentDateIndex) {
        const dateItems = carousel.querySelectorAll('.date-items h3');
        const today = new Date(); 
        today.setHours(0,0,0,0); 
        dateItems.forEach((item, index) => {
            const date = new Date(today);
            date.setDate(today.getDate() + currentDateIndex + index);
            const options = { weekday: 'long', day: 'numeric', month: 'long' };
            item.textContent = date.toLocaleDateString(undefined, options);
        });
    }

    function setupDateCarousel(dateCarousel, cinemaIndex) {
        const nextButton = dateCarousel.querySelector("#nextDate");
        const prevButton = dateCarousel.querySelector("#prevDate");
    
        let currentDateIndex = 0;
    
        nextButton.addEventListener("click", function (event) {
            event.preventDefault();
            if (currentDateIndex < 14) {
                currentDateIndex++;
                updateDates(dateCarousel, currentDateIndex);
            }
        });
    
        prevButton.addEventListener("click", function (event) {
            event.preventDefault();
            if (currentDateIndex > 0) {
                currentDateIndex--;
                updateDates(dateCarousel, currentDateIndex);
            }
        });
    
        // Initialize the date carousel for the current cinema
        updateDates(dateCarousel, currentDateIndex);
    }
    

    fetchMovieDetails(movieId);
    fetchCinemas()
});

document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const cinemaId = urlParams.get("id");

    function fetchCinemaDetails(cinemaId) {
        fetch(`script/php/get_cinema_details.php?id=${cinemaId}`)
            .then(response => response.json())
            .then(data => {
                updateCinemaDetails(data); 
            })
            .catch(error => console.error('Error fetching cinemas:', error));
    }

    function updateCinemaDetails(cinemaDetails){
        const cinemaName = document.getElementById('cinema-name');

        cinemaName.textContent = cinemaDetails.cinema_name; 
    }

    function fetchMovies() {
        fetch('script/php/get_movies.php')
            .then(response => response.json())
            .then(data => {
                updateMovieCarouselList(data); 
            })
            .catch(error => console.error('Error fetching movies:', error));
    }

    function updateMovieCarouselList(movies) {
        const movieCarouselContainer = document.getElementById('movie-carousel-container');

        movieCarouselContainer.innerHTML = '';

        let currentMovieBox = null;

        movies.forEach((movies, index) => {
            
            currentMovieBox = document.createElement('div');
            currentMovieBox.classList.add('cinema-box', 'movie-box');

            const movieName = movies.movie_name; 
            const movieLanguage = movies.languages; 
            const movieRating = movies.rating; 
            
            const movieTitle = document.createElement('h2');
            movieTitle.innerHTML = `${movieName} &#40;<span class="languages">${movieLanguage}</span>&#41; <span class="rating">${movieRating}</span>`;
            currentMovieBox.appendChild(movieTitle);

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

            const movieTime = document.createElement('div'); 
            movieTime.classList.add('cinema-time-list', 'movie-time-list'); 

            movieTime.innerHTML = `
                    <img src="${movies.poster}" alt="" class="movie-picture">
                    <input type="button" class="cinema-time movie-time" value="xx:xx">
                    <input type="button" class="cinema-time movie-time" value="xx:xx">
                    <input type="button" class="cinema-time movie-time" value="xx:xx">
            `;
    
            currentMovieBox.appendChild(dateCarousel);
            currentMovieBox.appendChild(movieTime);
    
            movieCarouselContainer.appendChild(currentMovieBox);

            setupDateCarousel(currentMovieBox.querySelector('.date-carousel'), index + 1);

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

    function setupDateCarousel(dateCarousel, movieIndex) {
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
    

    fetchCinemaDetails(cinemaId);
    fetchMovies()
});

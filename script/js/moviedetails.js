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


    let currentDateIndex1 = 0;
    let currentDateIndex2 = 0;

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

    
    const dateCarousel1 = document.getElementById("date-carousel-1");
    const dateCarousel2 = document.getElementById("date-carousel-2");
    
    dateCarousel1.querySelector("#nextDate").addEventListener("click", function (event) {
        event.preventDefault();
        if (currentDateIndex1 < 14) {
            currentDateIndex1++;
            updateDates(dateCarousel1, currentDateIndex1);
        }
    });
    
    dateCarousel1.querySelector("#prevDate").addEventListener("click", function (event) {
        event.preventDefault();
        if (currentDateIndex1 > 0) {
            currentDateIndex1--;
            updateDates(dateCarousel1, currentDateIndex1);
        }
    });
    
    dateCarousel2.querySelector("#nextDate").addEventListener("click", function (event) {
        event.preventDefault();
        if (currentDateIndex2 < 14) {
            currentDateIndex2++;
            updateDates(dateCarousel2, currentDateIndex2);
        }
    });
    
    dateCarousel2.querySelector("#prevDate").addEventListener("click", function (event) {
        event.preventDefault();
        if (currentDateIndex2 > 0) {
            currentDateIndex2--;
            updateDates(dateCarousel2, currentDateIndex2);
        }
    });
    
    updateDates(dateCarousel1, currentDateIndex1);
    updateDates(dateCarousel2, currentDateIndex2);

    fetchMovieDetails(movieId);
});

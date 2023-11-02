document.addEventListener("DOMContentLoaded", function () {
    let currentIndex = 0;
    let carouselInterval;
    function fetchMovies() {
        fetch('script/php/get_movies.php')
            .then(response =>
                response.json())
            .then(data => {
                updateCarousel(data);
                updateMovieList(data);
            })
            .catch(error => console.error('Error fetching movies:', error));
    }

    function updateCarousel(movies) {
        const firstFiveMovies = movies.slice(0, 5);

        const title = document.getElementById('movie-title');
        const genre = document.getElementById('movie-genre');
        const language = document.getElementById('movie-language');
        const duration = document.getElementById('movie-duration');
        const actor1 = document.getElementById('actor1');
        const actor2 = document.getElementById('actor2');
        const actor3 = document.getElementById('actor3');
        const actor4 = document.getElementById('actor4');
        const moviePoster = document.getElementById('movie-poster');

        function updateContent(index) {
            const movie = firstFiveMovies[index];
            title.textContent = movie.movie_name;
            genre.textContent = movie.genre;
            language.textContent = movie.languages;
            duration.textContent = movie.duration;
            const actors = movie.cast.split(', ');
            actor1.textContent = actors[0] || "";
            actor2.textContent = actors[1] || "";
            actor3.textContent = actors[2] || "";
            actor4.textContent = actors[3] || "";
            moviePoster.src = movie.banner;
        }

        updateContent(currentIndex);

        const bookButton = document.getElementById('bookButton');

        bookButton.addEventListener('click', () => {
            const movieId = firstFiveMovies[currentIndex].id;
            const url = `moviedetails.html?id=${movieId}`;
            window.location.href = url;
        });

        const prevButton = document.getElementById('prev-button');
        const nextButton = document.getElementById('next-button');

        prevButton.addEventListener('click', (event) => {
            event.preventDefault();
            clearInterval(carouselInterval);
            currentIndex = (currentIndex - 1 + firstFiveMovies.length) % firstFiveMovies.length;
            updateContent(currentIndex);
        });

        nextButton.addEventListener('click', (event) => {
            event.preventDefault();
            clearInterval(carouselInterval);
            currentIndex = (currentIndex + 1) % firstFiveMovies.length;
            updateContent(currentIndex);
        });

        function startCarouselAutoSwipe() {
            clearInterval(carouselInterval);

            carouselInterval = setInterval(() => {
                currentIndex = (currentIndex + 1) % firstFiveMovies.length;
                updateContent(currentIndex);
            }, 2000);
        }

        startCarouselAutoSwipe();

        document.addEventListener('click', (event) => {
            if (event.target !== prevButton && event.target !== nextButton) {
                startCarouselAutoSwipe();
            }
        });
    }

    function updateMovieList(movies) {
        const movieListContainer = document.getElementById('movie-list-container');

        movieListContainer.innerHTML = '';

        let currentMovieRow = null;

        movies.forEach((movie, index) => {
            if (index % 3 === 0) {
                currentMovieRow = document.createElement('div');
                currentMovieRow.classList.add('movie-row');
            }

            const movieButton = document.createElement('a');
            movieButton.href = `moviedetails.html?id=${movie.id}`;
            movieButton.setAttribute('role', 'button');

            movieButton.innerHTML = `
            <div class="movie-name">
                <img src="${movie.poster}" class="movie-pic">
                <h2>${movie.movie_name}</h2>
                <div class="movie-details movie-list-details">
                    <h3 class="details">${movie.genre}</h3>
                    <div class="line"></div>
                    <h3 class="details">${movie.languages}</h3>
                    <div class="line"></div>
                    <h3 class="details">${movie.duration}</h3>
                </div>
            </div>
            `;

            currentMovieRow.appendChild(movieButton);

            if ((index % 3 === 2) || (index === movies.length - 1)) {
                movieListContainer.appendChild(currentMovieRow);
            }
        });
    }

    fetchMovies();
});

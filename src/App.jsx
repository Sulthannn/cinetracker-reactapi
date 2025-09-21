import { useEffect, useState } from "react";
import StarRating from "./StarRating";

const API_KEY = "c24d3b1c";

const average = (arr) =>
  arr.reduce((acc, cur, i, arr) => acc + cur / arr.length, 0);

function Logo() {
  return (
    <div className="logo">
      <span role="img">🎫</span>
      <h1>CineTracker</h1>
    </div>
  );
}

function NumResults({ movies, dark, onToggleDark }) {
  return (
    <div className="num-results" style={{ display: 'flex', alignItems: 'center', gap: '1rem', justifySelf: 'end' }}>
      <p>There are <strong>{movies.length}</strong> results</p>
      <button
        onClick={onToggleDark}
        className="btn-theme"
        aria-label="Toggle theme"
        title={dark ? 'Switch to light mode' : 'Switch to dark mode'}
      >
        {dark ? '☀️' : '🌙'}
      </button>
    </div>
  );
}

function Search({ query, setQuery }) {
  return (
    <input
      className="search"
      type="text"
      placeholder="Search movies"
      value={query}
      onChange={(e) => setQuery(e.target.value)}
    />
  );
}

function Navbar({ children }) {
  return <nav className="nav-bar">{children}</nav>;
}

function BoxMovies({ children }) {
  const [isOpen, setIsOpen] = useState(true);
  return (
    <div className="box">
      <button className="btn-toggle" onClick={() => setIsOpen((open) => !open)}>
        {isOpen ? "–" : "+"}
      </button>
      {isOpen && children}
    </div>
  );
}

function MovieList({ movies, onSelectMovie }) {
  return (
    <ul className="list list-movies">
      {movies?.map((movie, index) => (
        <MovieItem movie={movie} key={index} onSelectMovie={onSelectMovie} />
      ))}
    </ul>
  );
}

function MovieItem({ movie, onSelectMovie }) {
  return (
    <li onClick={() => onSelectMovie(movie.imdbID)}>
      <img src={movie.Poster} alt={`${movie.Title} poster`} />
      <h3><b>{movie.Title}</b></h3>
      <div>
        <p>
          <span>📅</span>
          <span>{movie.Year}</span>
        </p>
      </div>
    </li>
  );
}

function WatchedSummary({ watched }) {
  const avgImdbRating = average(watched.map((movie) => movie.imdbRating));
  const avgUserRating = average(watched.map((movie) => movie.userRating));
  const avgRuntime = average(watched.map((movie) => movie.runtime));

  return (
    <div className="summary">
      <h2>Movies you watched</h2>
      <div>
        <p>
          <span>#️⃣</span>
          <span>{watched.length} movies</span>
        </p>
        <p>
          <span>🎬</span>
          <span>{avgImdbRating.toFixed(1)}</span>
        </p>
        <p>
          <span>🌟</span>
          <span>{avgUserRating.toFixed(1)}</span>
        </p>
        <p>
          <span>⏳</span>
          <span>{Math.trunc(avgRuntime)} min</span>
        </p>
      </div>
    </div>
  );
}

function MovieDetails({ selectedId, onCloseMovie, onAddWatched, watched }) {
  const [movie, setMovie] = useState({});
  const [isLoading, setIsLoading] = useState(false);
  const [userRating, setUserRating] = useState("");

  const isWatched = watched.some((movie) => movie.imdbID === selectedId);
  const watchedUserRating = watched.find(
    (movie) => movie.imdbID === selectedId
  )?.userRating;

  const {
    Title: title,
    Year: year,
    Released: released,
    Poster: poster,
    Runtime: runtime,
    imdbRating,
    Plot: plot,
    Director: director,
    Actors: actors,
    Genre: genre,
  } = movie;

  function handleAddWatched() {
    const newWatchedMovie = {
      imdbID: selectedId,
      title,
      year,
      poster,
      imdbRating: Number(imdbRating),
      runtime: Number(runtime.split(" ").at(0)),
      userRating: Number(userRating),
    };
    console.log(newWatchedMovie);
    onAddWatched(newWatchedMovie);
    onCloseMovie();
  }

  useEffect(() => {
    async function getMovieDetails() {
      setIsLoading(true);
      const response = await fetch(
        `https://www.omdbapi.com/?apikey=${API_KEY}&i=${selectedId}`
      );
      const data = await response.json();
      setMovie(data);
      setIsLoading(false);
    }
    getMovieDetails();
  }, [selectedId]);

  useEffect(() => {
    if (!title) return;
    document.title = `CineTracker | ${title}`;

    return () => {
      document.title = "CineTracker";
    };
  }, [title]);

  return (
    <div className="details">
      {isLoading ? (
        <Loader />
      ) : (
        <>
          <header>
            <button className="btn-back" onClick={onCloseMovie}>
              x
            </button>
            <img src={poster} alt={`${title} poster`} />
            <div className="details-overview">
              <h2><b>{title}</b></h2>
              <p>{released}</p>
              <p>{genre}</p>
              <p>
                <span>⏳</span>
                <span>{runtime}</span>
              </p>
              <p>
                <span>🎬</span>
                <span>{imdbRating}</span>
              </p>
            </div>
          </header>
          <section>
            <p>
              <em>{plot}</em>
            </p>
            <p>Starring <b>{actors}</b></p>
            <p>Directed by {director}</p>
            <div className="rating">
              {!isWatched ? (
                <>
                  <StarRating max={5} size={24} onSetRating={setUserRating} />
                  {userRating > 0 && (
                    <button className="btn-add" onClick={handleAddWatched}>
                      + Add to Watched
                    </button>
                  )}
                </>
              ) : (
                <p>
                  You have watched this movie with a rating of{" "}
                  <b>{watchedUserRating} / 5</b>
                </p>
              )}
            </div>
          </section>
        </>
      )}
    </div>
  );
}

function WatchedList({ watched, onDeleteWatched }) {
  return (
    <ul className="list">
      {watched.map((movie) => (
        <li key={movie.imdbID}>
          <img src={movie.poster} alt={`${movie.title} poster`} />
          <h3><b>{movie.title}</b></h3>
          <div>
            <p>
              <span>🎬</span>
              <span>{movie.imdbRating}</span>
            </p>
            <p>
              <span>🌟</span>
              <span>{movie.userRating}</span>
            </p>
            <p>
              <span>⏳</span>
              <span>{movie.runtime} min</span>
            </p>
            <button className="btn-delete" onClick={() => onDeleteWatched(movie.imdbID)}>
              -
            </button>
          </div>
        </li>
      ))}
    </ul>
  );
}

function Main({ children }) {
  return <main className="main">{children}</main>;
}

function Loader() {
  return (
    <div className="loader">
      <div className="loading-bar">
        <div className="bar"></div>
      </div>
    </div>
  );
}

function ErrorMessage({ message }) {
  return (
    <div className="error">
      <span>⛔</span> {message}
    </div>
  );
}

function SkeletonList({ count = 8 }) {
  return (
    <ul className="list list-movies">
      {Array.from({ length: count }).map((_, i) => (
        <li key={i}>
          <div className="w-full h-16 bg-slate-400/20 animate-pulse rounded" style={{ gridRow: '1 / -1' }}></div>
          <div className="h-5 w-2/3 bg-slate-400/20 animate-pulse rounded"></div>
          <div className="flex items-center gap-6">
            <div className="h-4 w-24 bg-slate-400/20 animate-pulse rounded"></div>
          </div>
        </li>
      ))}
    </ul>
  );
}

export default function App() {
  const [movies, setMovies] = useState([]);
  const [watched, setWatched] = useState([]);
  const [isLoading, setIsLoading] = useState(false);
  const [isError, setIsError] = useState("");
  const [query, setQuery] = useState("");
  const [selectedId, setSelectedId] = useState(null);
  const [dark, setDark] = useState(true);

  useEffect(() => {
    const body = document.body;
    if (dark) body.classList.remove('light');
    else body.classList.add('light');
  }, [dark]);

  function handleAddWatched(movie) {
    setWatched((watched) => [...watched, movie]);
  }

  function handleDeleteWatched(id) {
    setWatched((watched) => watched.filter((movie) => movie.imdbID !== id));
  }  

  function handleSelectMovie(id) {
    setSelectedId((selectedId) => (selectedId === id ? null : id));
  }

  function handleCloseMovie() {
    setSelectedId(null);
  }

  useEffect(() => {
    const controller = new AbortController();
    async function fetchMovies() {
      try {
        setIsLoading(true);
        setIsError("");
        const response = await fetch(
          `https://www.omdbapi.com/?apikey=${API_KEY}&s=${query}`,
          { signal: controller.signal }
        );

        if (!response.ok) {
          throw new Error(response.statusText);
        }

        const data = await response.json();

        if (data.Response === "False") {
          throw new Error(data.Error);
        }

        console.log(data.Search);

        setMovies(data.Search);
        setIsError("");
      } catch (e) {
        if (e.name === "AbortError") return;
        console.error(e);
        setIsError(e.message);
      } finally {
        setIsLoading(false);
      }
    }

    if (query.length < 3) {
      setMovies([]);
      setIsError("");
      return;
    }

    fetchMovies();
    return function () {
      controller.abort();
    };
  }, [query]);

  return (
    <>
      <Navbar>
        <Logo />
        <Search query={query} setQuery={setQuery} />
        <NumResults movies={movies} dark={dark} onToggleDark={() => setDark((d) => !d)} />
      </Navbar>
      <Main>
        <BoxMovies>
          {isLoading && !isError && <SkeletonList />}
          {!isLoading && !isError && (
            movies.length > 0 ? (
              <MovieList movies={movies} onSelectMovie={handleSelectMovie} />
            ) : (
              <div className="error" style={{ padding: '3.2rem' }}>
                <span>🔎</span> Type the movie title in the search field
              </div>
            )
          )}
          {isError && <ErrorMessage message={isError} />}
        </BoxMovies>
        <BoxMovies>
          {selectedId ? (
            <MovieDetails
              selectedId={selectedId}
              onCloseMovie={handleCloseMovie}
              onAddWatched={handleAddWatched}
              watched={watched}
            />
          ) : (
            <>
              <WatchedSummary watched={watched} />
              <WatchedList watched={watched} onDeleteWatched={handleDeleteWatched} />{" "}
            </>
          )}
        </BoxMovies>
      </Main>
    </>
  );
}
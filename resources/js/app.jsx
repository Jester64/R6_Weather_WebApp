import React from 'react';
import ReactDOM from 'react-dom/client';
import WeatherApp from './components/WeatherApp';

const App = () => {
    return <h1>Hello from React + Laravel!</h1>;
};

ReactDOM.createRoot(document.getElementById('app')).render(<WeatherApp />);
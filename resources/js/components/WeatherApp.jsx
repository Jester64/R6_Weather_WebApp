import React, { useState, useEffect } from 'react';
import axios from 'axios';

const WeatherApp = () => {
    const [city, setCity] = useState('Brisbane');
    const [forecast, setForecast] = useState([]);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);

    const fetchForecast = async (selectedCity) => {
        setLoading(true);
        setError(null);

        try {
            const response = await axios.get(`/api/forecast?city=${selectedCity}`);
            setForecast(response.data);
        } catch (err) {
            setError('Failed to fetch forecast.');
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchForecast(city);
    }, [city]);

    return (
        <div className="p-4 font-sans">
            <h1 className="text-2xl mb-4">5-Day Weather Forecast</h1>
            <select
                value={city}
                onChange={(e) => setCity(e.target.value)}
                className="mb-4 p-2 border"
            >
                <option value="Brisbane">Brisbane</option>
                <option value="Sydney">Sydney</option>
                <option value="Melbourne">Melbourne</option>
                <option value="Sunshine Coast">Sunshine Coast</option>
            </select>

            {loading && <p>Loading...</p>}
            {error && <p className="text-red-500">{error}</p>}

            {forecast.length > 0 && (
                <table className="table-auto border-collapse w-full">
                    <thead>
                        <tr>
                            <th className="border p-2">Day</th>
                            <th className="border p-2">Min Temp</th>
                            <th className="border p-2">Max Temp</th>
                            <th className="border p-2">Summary</th>
                        </tr>
                    </thead>
                    <tbody>
                        {forecast.map((day, index) => (
                            <tr key={index}>
                                <td className="border p-2">{day.day}</td>
                                <td className="border p-2">{day.min_temp}°C</td>
                                <td className="border p-2">{day.max_temp}°C</td>
                                <td className="border p-2">{day.summary}</td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            )}
        </div>
    );
};

export default WeatherApp;



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
        <div className="Main">
            <h1 className="Title_Header">5-Day Weather Forecast</h1>

            <div className="Select_City">
                <label htmlFor="city" className="Select_City_Label">Select City:</label>
                <select
                    id="city"
                    value={city}
                    onChange={(e) => setCity(e.target.value)}
                    className="Select_Tool"
                >
                    <option value="Brisbane">Brisbane</option>
                    <option value="GoldCoast">Gold Coast</option>
                    <option value="Maroochydore">Sunshine Coast</option>
                </select>
            </div>

            {loading && <p className="Loading_Notification">Loading forecast...</p>}
            {error && <p className="Error_Notification">{error}</p>}

            {!loading && forecast.length > 0 && (
                <div className="Main_Table_Container">
                    <table className="Main_Table">
                        <thead className="Main_Table_Head">
                            <tr>
                                <th className="Main_Table_Head_Day">Day</th>
                                <th className="Main_Table_Head_Min_Temp">Min Temp</th>
                                <th className="Main_Table_Head_Max_Temp">Max Temp</th>
                                <th className="Main_Table_Head_Summary">Summary</th>
                            </tr>
                        </thead>
                        <tbody>
                            {forecast.map((day, index) => (
                                <tr key={index} className="Main_Table_Row">
                                    <td className="Main_Table_Row_Day">{day.day}</td>
                                    <td className="Main_Table_Row_Min_Temp">{day.min_temp}°C</td>
                                    <td className="Main_Table_Row_Max_Temp">{day.max_temp}°C</td>
                                    <td className="Main_Table_Row_Summary">{day.summary}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            )}

            {!loading && forecast.length === 0 && !error && (
                <p className="Forecast_Retrieve_Fail">No forecast data available.</p>
            )}
        </div>
    );
};

export default WeatherApp;
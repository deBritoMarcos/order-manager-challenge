import { useEffect, useState } from "react";

export const useFetch = () => {
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);
    const [data, setData] = useState([]);

    const [codeParam, setCodeParam] = useState(null);
    const [, setStatusParam] = useState(null);

    
    useEffect(() => {
        const getOrders = async () => {
            setLoading(true);

            await fetch('http://127.0.0.1:8000/api/orders')
                .then((response) => response.json())
                .then((data) => {
                    setData(data.data)
                })
                .catch(error => {
                    setError(error)
                })
                .finally(() => {
                    setLoading(false);
                });
            
        }

        getOrders();
    }, []);

    return { data, loading, error }; 
}
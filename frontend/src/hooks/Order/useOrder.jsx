import { useState } from "react";

export const useOrder = (id) => {
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);
    const [order, setOrder] = useState(null);

    const fetchOrder = async () => {
        setLoading(true);

        let url = 'http://127.0.0.1:8000/api/orders/' + id;

        await fetch(url)
            .then((response) => response.json())
            .then((data) => {
                setOrder(data.data)
            })
            .catch(error => {
                setError(error)
            })
            .finally(() => {
                setLoading(false);
            });
    }

    return { order, loading, error, fetchOrder }; 
}
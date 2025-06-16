import { useState } from "react";

export const useOrders = () => {
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);
    const [orders, setOrders] = useState([]);

    const fetchOrders = async (code = null, status = null) => {
        setLoading(true);

        let url = 'http://127.0.0.1:8000/api/orders';

        if (code || status) {
            url = makeQueryRoute(url, code, status);
        }

        await fetch(url)
            .then((response) => response.json())
            .then((data) => {
                setOrders(data.data)
            })
            .catch(error => {
                setError(error)
            })
            .finally(() => {
                setLoading(false);
            });
        
    }

    const makeQueryRoute = (route, code = null, status = null) => {
        if (!code && !status) {
            return false;
        }

        const params = new URLSearchParams();
        
        if (code !== null) {
            params.append("code", code);
        }

        if (status !== null) {
            params.append("status", status);
        }

        return `${route}?${params.toString()}`;        
    }

    return { orders, loading, error, fetchOrders }; 
}
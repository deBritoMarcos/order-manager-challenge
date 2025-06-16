import { Link, useParams } from 'react-router-dom'
import { useOrder } from '../../hooks/Order/useOrder'
import { useEffect, useState } from 'react';

function Detail() {
    const { id } = useParams();

    const { order, loading, error, fetchOrder } = useOrder(id);

    const [lockButton, setLockButton] = useState(false);

    const updateOrderSituation = async (order) => {
        setLockButton(true);

        let url = `http://127.0.0.1:8000/api/orders/${order.id}/situation`;

        await fetch(url, {method: 'PUT'})
            .then((response) => response.json())
            .catch(error => {
                setError(error)
            })
            .finally(() => {
                setLockButton(false);
            });
    }

    useEffect(() => {
        fetchOrder();
    }, []);

    return (
        <div>
            <h1>Order Details</h1>

            {(order && !loading) ? (
                <div>
                    <Link to="/">Voltar</Link>
                    <p>Code: {order.code}</p>
                    <p>Situation: {order.status}</p>
                    <p>Creation date: {order.created_at}</p>

                    {order.status == 'pending' && (
                        <button 
                            onClick={() => updateOrderSituation(order)} 
                        >Start</button>
                    )}

                    {order.status == 'started' && <button onClick={() => updateOrderSituation(order)}>Finish</button>}

                    {order.status == 'finished' && <button disabled>Finished</button>}
                    
                </div>            
            ) : (
                <li>
                    <p>Loading Order</p>
                </li>
            )}

            
        </div>
    )
}

export default Detail
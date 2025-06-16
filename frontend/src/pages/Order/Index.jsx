import { useEffect, useState } from 'react';
import { useOrders } from '../../hooks/Order/useOrders'

function Index() {
    const { orders, loading, error, fetchOrders } = useOrders();

    const [codeQuery, setCodeQuery] = useState(null);
    const [statusQuery, setStatusQuery] = useState(null);

    useEffect(() => {
        fetchOrders();
    }, []);

    const handleSearchSubmit = (e) => {
        e.preventDefault();

        if (!codeQuery && !statusQuery) {
            return false;
        }

        fetchOrders(codeQuery, statusQuery);
    }

    return (
        <div>
            <h1>Orders:</h1>

            <div>
                <form onSubmit={handleSearchSubmit}>
                    <label>
                        <input 
                            type="number" 
                            name="code" 
                            placeholder='Enter the order code'
                            onChange={(e) => setCodeQuery(e.target.value)}
                        />
                    </label>

                    <label>
                        <select 
                            name="status"
                            onChange={(e) => setStatusQuery(e.target.value)}
                        >
                            <option value="pending">Pending</option>
                            <option value="started">Started</option>
                            <option value="finished">Finished</option>
                        </select>
                    </label>

                    <button>Pesquisar</button>
                </form>
            </div>

            <ul>
                {(orders && !loading) ? orders.map((order) => (
                    <li key={order.id}>
                        <p>Order {order.code}</p>
                        <p>{order.status}</p>
                        
                        {/* <Link>Details</Link> */}
                        {/*<Link to={`/order/${order.id}`}>Details</Link> */}
                    </li>
                )) : (
                    <li>
                        <p>Loading Orders</p>
                    </li>
                )}
                
            </ul>
        </div>
    )
}

export default Index
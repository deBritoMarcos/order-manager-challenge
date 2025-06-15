import { useFetch } from '../../hooks/Order/useFetch'

function Index() {

    const { data: orders, loading, error } = useFetch();

    return (
        <div>
            <h1>Orders:</h1>

            <div>
                <form>
                    <label>
                        <input type="number" name="code" placeholder='Enter the order code' />
                    </label>

                    <label>
                        <select name="status">
                            <option value="pending">Pending</option>
                            <option value="started">Started</option>
                            <option value="finished">Finished</option>
                        </select>
                    </label>

                    <button>Pesquisar</button>
                </form>
            </div>

            <ul>
                {orders && orders.map((order) => (
                    <li key={order.id}>
                        <p>Order {order.code}</p>
                        <p>{order.status}</p>
                        
                        {/* <Link>Details</Link> */}
                        <Link to={}>Details</Link>
                    </li>
                ))}

                {(!orders && loading) && (
                    <li key={order.id}>
                        <p>Loading Orders</p>
                    </li>
                )}
                
            </ul>
        </div>
    )
}

export default Index
# Digital nomads test task
## SQL tests:
	
	### 1\. Show Stores, that have products with Christmas, Winter Tags
		```sql
		SELECT 
			Store.id AS store_id,
			Store.name AS store_name
		FROM 
			Store 
		LEFT JOIN Product ON Product.store_id = Store.id
		LEFT JOIN TagConnect ON TagConnect.product_id = Product.id
		LEFT JOIN Tag ON Tag.id = TagConnect.tag_id
		WHERE 
			Tag.tag_name IN ('Christmas', 'Winter')
		GROUP BY Store.id
		ORDER BY id
	```
	### 2\.  Show Users, that never bought Product from Store with id == 5
		```sql
		SELECT 
			* 
		FROM `User`
		WHERE `User`.id NOT IN (
			SELECT 
				DISTINCT `Order`.customer_id
			FROM 
				`Order` 
			LEFT JOIN OrderItem ON OrderItem.order_id = `Order`.id
			LEFT JOIN Product ON Product.id = OrderItem.product_id 
			WHERE 
				Product.store_id = 5
		)
	```
	### 3\. Show Users, that had spent more than $1000
		```sql
		SELECT 
			`User`.id AS user_id,
			`User`.name AS user_name,
			SUM(Product.price) AS spent
		FROM `User`
			LEFT JOIN `Order` ON `Order`.customer_id = `User`.id 
			LEFT JOIN OrderItem ON OrderItem.order_id = `Order`.id
			LEFT JOIN Product ON Product.id = OrderItem.product_id 
		GROUP BY `User`.id
		HAVING spent > 1000	
	```
	### 4\. Show Stores, that have not any Sells
		```sql
		SELECT 
			*
		FROM Store 
		WHERE id NOT IN (
			SELECT 
			  DISTINCT Product.store_id  
			FROM
				OrderItem 
			LEFT JOIN Product ON OrderItem.product_id = Product.id
		)
	```
	### 5\. Show Mostly sold Tags
		```sql
		SELECT 
			Tag.id AS tag_id,
			Tag.tag_name AS tag_name,
			COUNT(OrderItem.order_id) sell_count
		FROM Tag 
		LEFT JOIN TagConnect ON TagConnect.tag_id = Tag.id
		LEFT JOIN Product ON Product.id = TagConnect.product_id
		LEFT JOIN OrderItem ON OrderItem.product_id = Product.id AND NOT ISNULL(OrderItem.product_id)
		GROUP BY Tag.id
		ORDER BY sell_count DESC
	```
	### 6\. Show Monthly Store Earnings Statistics 
		```sql
		SELECT 
			Store.id AS store_id,
			Store.name AS store_name,
			YEAR(`Order`.order_date) AS order_year,
			MONTH(`Order`.order_date) AS order_month,
			SUM(Product.price) AS earnings
		FROM OrderItem 
		LEFT JOIN Product ON Product.id = OrderItem.product_id
		LEFT JOIN Store ON Store.id = Product.store_id
		LEFT JOIN `Order` ON `Order`.id = OrderItem.order_id
		GROUP BY 
			store_id,
			order_year,
			order_month
		ORDER BY 
			order_year DESC, 
			order_month DESC, 
			earnings DESC
	```
## SQL optimization:
	1. Need to have "price" field in OrderItem table, to improve perfomance and store price for purchase time
	2. Beter to rename:
		2.1. TagConnect table to ProductTag
		2.2. "Tag.tag_name" field to "Tag.name"
		2.3. "Order.order_number" field to Order.number
		2.4. "Order.order_date" field to "Order.`date`" or "Order.created"
		2.5. "Order.customer_id" field to "Order.user_id"
	3. TagConnect don't need field "id", just primary key (tag_id, product_id)
	4. Add unique key on Tag.tag_name. It's prevent functions like StoreManager::getTotalUniqueTags and improve perfomance	
	
## Optimization test:	
	1. Line 34 should be "$tagCount = self::getTotalUniqueTags();"
	2. Line 57 should be "$query = 'SELECT * FROM products WHERE store_id = :store';"

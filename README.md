# market-backend

✅ Main Categories:
Electronics

Clothing

Home Appliances

Cosmetics

Books

🔽 Subcategories for each:
Electronics:

Mobile Phones

Laptops

Headphones

Chargers

Clothing:

Men

Women

Kids

Shoes

Books:

Novels

Self-Development

Technology

History

1. Users (المستخدمين)
id

name

email

password (مشفرة)

role (عميل، مدير، مشرف)

created_at

2. Products (المنتجات)
id

name

description

price

stock_quantity

category_id (ربط بفئة المنتج)

image_url

created_at

3. Categories (الفئات)
id

name

parent_id (لو عندك فئات داخل فئات)

4. Orders (الطلبات)
id

user_id

status (قيد المعالجة، تم الشحن، تم التوصيل...)

total_price

created_at

5. Order_Items (تفاصيل الطلبات)
id

order_id

product_id

quantity

price_at_purchase

6. Cart (السلة)
id

user_id

product_id

quantity

7. Payments (الدفع)
id

order_id

payment_method (بطاقة، PayPal، تحويل)

payment_status

paid_at

8. Shipping_Address (عناوين التوصيل)
id

user_id

order_id

address_line

city

state

postal_code

country

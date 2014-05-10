/*	a. Для заданного списка товаров получить названия всех категорий, в которых представлены товары; 
	products - 3, 7, 10, 11
*/
	SELECT DISTINCT id, name FROM categories ctg 
	LEFT JOIN product_to_categories ptc ON ptc.categ_id = ctg.id 
	WHERE ptc.product_id IN('3','7','10','11')



/*	b. Для заданной категории получить список предложений всех товаров из этой категории и ее дочерних категорий;
	category - 20
 */
	SELECT prd.id, prd.name FROM products prd 
	LEFT JOIN product_to_categories ptc ON ptc.product_id = prd.id 
	WHERE ptc.categ_id = '20'
	UNION
	SELECT prd.id, prd.name FROM products prd
	LEFT JOIN product_to_categories ptc ON ptc.product_id = prd.id
	WHERE ptc.categ_id IN(SELECT id FROM categories WHERE parent_id = '20')
	


/*	c. Для заданного списка категорий получить количество предложений товаров в каждой категории; 
	categories '3','11','7','14'
*/
	SELECT categ_id, COUNT(product_id) p_count FROM product_to_categories
	WHERE categ_id IN('3','11','7','14') GROUP BY categ_id



/*	d. Для заданного списка категорий получить общее количество уникальных предложений товара;
	categories '3','11','7','14'
*/
	SELECT SUM(p_count) p_sum FROM (
		SELECT ptc.categ_id, COUNT(product_id) p_count FROM product_to_categories ptc
		WHERE ptc.categ_id IN('3','11','7','14') 
		AND ptc.product_id NOT IN (
			SELECT sub_ptc.product_id FROM product_to_categories sub_ptc
			WHERE sub_ptc.categ_id IN('3','11','7','14') AND sub_ptc.categ_id != ptc.categ_id
		)
		GROUP BY categ_id
	) t1



/*	e. Для заданной категории получить ее полный путь в дереве (breadcrumb, «хлебные крошки»). 
	category - 10
*/
	function breadcrumb($id){
		$q = mysql_query('SELECT id, name, parent_id FROM categories WHERE id = "'.$id.'"');
		$cat = mysql_fetch_assoc($q);
		if($cat['parent_id'] != 0){
			return breadcrumb($cat['id'])." -> ".$cat['name'];
		}else{
			return $cat['name'];
		}
	}

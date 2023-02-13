<?php

namespace App\Helpers;

trait Queries
{
	public function paginateQuery($query, $per_page = 3, $sort = 'desc', $select = ['id', 'user_id', 'movie_id', 'quote_image', 'quote_title'])
	{
		return $query
			->select($select)
			->orderBy('id', $sort)
			->paginate($per_page);
	}
}

tracker	cache	key	varchar	NO	NULL	
tracker	cache	value	mediumtext	NO	NULL	
tracker	cache	expiration	int	NO	NULL	
tracker	cache_locks	key	varchar	NO	NULL	
tracker	cache_locks	owner	varchar	NO	NULL	
tracker	cache_locks	expiration	int	NO	NULL	
tracker	clients	id	bigint	NO	NULL	
tracker	clients	name	varchar	NO	NULL	
tracker	clients	created_at	timestamp	YES	NULL	
tracker	clients	updated_at	timestamp	YES	NULL	
tracker	failed_jobs	id	bigint	NO	NULL	
tracker	failed_jobs	uuid	varchar	NO	NULL	
tracker	failed_jobs	connection	text	NO	NULL	
tracker	failed_jobs	queue	text	NO	NULL	
tracker	failed_jobs	payload	longtext	NO	NULL	
tracker	failed_jobs	exception	longtext	NO	NULL	
tracker	failed_jobs	failed_at	timestamp	NO	CURRENT_TIMESTAMP	
tracker	job_batches	id	varchar	NO	NULL	
tracker	job_batches	name	varchar	NO	NULL	
tracker	job_batches	total_jobs	int	NO	NULL	
tracker	job_batches	pending_jobs	int	NO	NULL	
tracker	job_batches	failed_jobs	int	NO	NULL	
tracker	job_batches	failed_job_ids	longtext	NO	NULL	
tracker	job_batches	options	mediumtext	YES	NULL	
tracker	job_batches	cancelled_at	int	YES	NULL	
tracker	job_batches	created_at	int	NO	NULL	
tracker	job_batches	finished_at	int	YES	NULL	
tracker	jobs	id	bigint	NO	NULL	
tracker	jobs	queue	varchar	NO	NULL	
tracker	jobs	payload	longtext	NO	NULL	
tracker	jobs	attempts	tinyint	NO	NULL	
tracker	jobs	reserved_at	int	YES	NULL	
tracker	jobs	available_at	int	NO	NULL	
tracker	jobs	created_at	int	NO	NULL	
tracker	migrations	id	int	NO	NULL	
tracker	migrations	migration	varchar	NO	NULL	
tracker	migrations	batch	int	NO	NULL	
tracker	password_reset_tokens	email	varchar	NO	NULL	
tracker	password_reset_tokens	token	varchar	NO	NULL	
tracker	password_reset_tokens	created_at	timestamp	YES	NULL	
tracker	personal_access_tokens	id	bigint	NO	NULL	
tracker	personal_access_tokens	tokenable_type	varchar	NO	NULL	
tracker	personal_access_tokens	tokenable_id	bigint	NO	NULL	
tracker	personal_access_tokens	name	varchar	NO	NULL	
tracker	personal_access_tokens	token	varchar	NO	NULL	
tracker	personal_access_tokens	abilities	text	YES	NULL	
tracker	personal_access_tokens	last_used_at	timestamp	YES	NULL	
tracker	personal_access_tokens	expires_at	timestamp	YES	NULL	
tracker	personal_access_tokens	created_at	timestamp	YES	NULL	
tracker	personal_access_tokens	updated_at	timestamp	YES	NULL	
tracker	sessions	id	varchar	NO	NULL	
tracker	sessions	user_id	bigint	YES	NULL	
tracker	sessions	ip_address	varchar	YES	NULL	
tracker	sessions	user_agent	text	YES	NULL	
tracker	sessions	payload	longtext	NO	NULL	
tracker	sessions	last_activity	int	NO	NULL	
tracker	users	id	bigint	NO	NULL	
tracker	users	name	varchar	NO	NULL	
tracker	users	email	varchar	NO	NULL	
tracker	users	email_verified_at	timestamp	YES	NULL	
tracker	users	password	varchar	NO	NULL	
tracker	users	remember_token	varchar	YES	NULL	
tracker	users	created_at	timestamp	YES	NULL	
tracker	users	updated_at	timestamp	YES	NULL	
tracker	visits	id	bigint	NO	NULL	
tracker	visits	page_url	varchar	NO	NULL	
tracker	visits	visitor_id	varchar	YES	NULL	
tracker	visits	ip_address	varchar	NO	NULL	
tracker	visits	user_agent	text	YES	NULL	
tracker	visits	referrer	varchar	YES	NULL	
tracker	visits	visit_time	timestamp	NO	CURRENT_TIMESTAMP	
tracker	visits	created_at	timestamp	YES	NULL	
tracker	visits	updated_at	timestamp	YES	NULL	
tracker	visits	website_id	bigint	NO	NULL	
tracker	websites	id	bigint	NO	NULL	
tracker	websites	url	text	NO	NULL	
tracker	websites	client_id	bigint	NO	NULL	
tracker	websites	created_at	timestamp	YES	NULL	
tracker	websites	updated_at	timestamp	YES	NULL	

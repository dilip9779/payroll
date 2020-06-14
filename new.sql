-- Login Time Add
ALTER TABLE public.bds_users ADD COLUMN last_signin timestamp without time zone;
ALTER TABLE public.bds_users ALTER COLUMN last_signin SET DEFAULT now();
ALTER TABLE public.bds_users ADD COLUMN ip character varying;
ALTER TABLE public.eis_users ADD COLUMN last_signin timestamp without time zone;
ALTER TABLE public.eis_users ALTER COLUMN last_signin SET DEFAULT now();
ALTER TABLE public.eis_users ADD COLUMN ip character varying;
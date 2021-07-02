CREATE OR REPLACE FUNCTION "public"."connectby"(text, text, text, text, int4)
  RETURNS SETOF "pg_catalog"."record" AS '$libdir/tablefunc', 'connectby_text'
  LANGUAGE 'c' STABLE STRICT  COST 1
 ROWS 1000
;

ALTER FUNCTION "public"."connectby"(text, text, text, text, int4) OWNER TO "postgres";

CREATE OR REPLACE FUNCTION "public"."connectby"(text, text, text, text, int4, text)
  RETURNS SETOF "pg_catalog"."record" AS '$libdir/tablefunc', 'connectby_text'
  LANGUAGE 'c' STABLE STRICT  COST 1
 ROWS 1000
;

ALTER FUNCTION "public"."connectby"(text, text, text, text, int4, text) OWNER TO "postgres";

CREATE OR REPLACE FUNCTION "public"."connectby"(text, text, text, text, text, int4)
  RETURNS SETOF "pg_catalog"."record" AS '$libdir/tablefunc', 'connectby_text_serial'
  LANGUAGE 'c' STABLE STRICT  COST 1
 ROWS 1000
;

ALTER FUNCTION "public"."connectby"(text, text, text, text, text, int4) OWNER TO "postgres";

CREATE OR REPLACE FUNCTION "public"."connectby"(text, text, text, text, text, int4, text)
  RETURNS SETOF "pg_catalog"."record" AS '$libdir/tablefunc', 'connectby_text_serial'
  LANGUAGE 'c' STABLE STRICT  COST 1
 ROWS 1000
;

ALTER FUNCTION "public"."connectby"(text, text, text, text, text, int4, text) OWNER TO "postgres";

CREATE OR REPLACE FUNCTION "public"."crosstab"(text)
  RETURNS SETOF "pg_catalog"."record" AS '$libdir/tablefunc', 'crosstab'
  LANGUAGE 'c' STABLE STRICT  COST 1
 ROWS 1000
;

ALTER FUNCTION "public"."crosstab"(text) OWNER TO "postgres";

CREATE OR REPLACE FUNCTION "public"."crosstab"(text, int4)
  RETURNS SETOF "pg_catalog"."record" AS '$libdir/tablefunc', 'crosstab'
  LANGUAGE 'c' STABLE STRICT  COST 1
 ROWS 1000
;

ALTER FUNCTION "public"."crosstab"(text, int4) OWNER TO "postgres";

CREATE OR REPLACE FUNCTION "public"."crosstab"(text, text)
  RETURNS SETOF "pg_catalog"."record" AS '$libdir/tablefunc', 'crosstab_hash'
  LANGUAGE 'c' STABLE STRICT  COST 1
 ROWS 1000
;

ALTER FUNCTION "public"."crosstab"(text, text) OWNER TO "postgres";

CREATE OR REPLACE FUNCTION "public"."crosstab2"(text)
  RETURNS SETOF "public"."tablefunc_crosstab_2" AS '$libdir/tablefunc', 'crosstab'
  LANGUAGE 'c' STABLE STRICT  COST 1
 ROWS 1000
;

ALTER FUNCTION "public"."crosstab2"(text) OWNER TO "postgres";

CREATE OR REPLACE FUNCTION "public"."crosstab3"(text)
  RETURNS SETOF "public"."tablefunc_crosstab_3" AS '$libdir/tablefunc', 'crosstab'
  LANGUAGE 'c' STABLE STRICT  COST 1
 ROWS 1000
;

ALTER FUNCTION "public"."crosstab3"(text) OWNER TO "postgres";

CREATE OR REPLACE FUNCTION "public"."crosstab4"(text)
  RETURNS SETOF "public"."tablefunc_crosstab_4" AS '$libdir/tablefunc', 'crosstab'
  LANGUAGE 'c' STABLE STRICT  COST 1
 ROWS 1000
;

ALTER FUNCTION "public"."crosstab4"(text) OWNER TO "postgres";

CREATE OR REPLACE FUNCTION "public"."generate_crosstab_sql"("source_sql" text, "category_sql" text, "v_matrix_col_type" varchar, "v_matrix_rows_name_and_type" varchar)
  RETURNS "pg_catalog"."text" AS $BODY$ 

DECLARE
	v_sql TEXT ; curs1 refcursor ; v_val TEXT ; v_sql2 TEXT ; v_sql3 TEXT ;  

BEGIN
	v_sql = v_matrix_rows_name_and_type || ' TEXT' ; 
	
	v_sql2 = v_matrix_rows_name_and_type ; 
	
	v_sql3 = chr(39) || 'Total' || chr(39) || '::TEXT ' ;

	OPEN curs1 FOR EXECUTE category_sql ; 
		LOOP 
			FETCH curs1 INTO v_val ; 
			
			EXIT WHEN v_val IS NULL ; 
			
			v_sql = v_sql || ' , "' || v_val || '" ' || v_matrix_col_type ; 
			
			IF v_val <> 'Total' THEN
				v_sql2 = v_sql2 || ' , COALESCE("' || v_val || '", 0) || ' || chr(39) || '<BR>(' || chr(39) ||' || ROUND((COALESCE("' || v_val || '"::DECIMAL,0) * 100/"Total"::DECIMAL), 1) || ' || chr(39) || '%)' || chr(39) || '::TEXT  "' || v_val || '<BR>(%)"';
				RAISE NOTICE '%',v_sql2;
			ELSE
				v_sql2 = v_sql2 || ' , COALESCE("' || v_val || '", 0)::TEXT AS "' || v_val || '"';
				RAISE NOTICE '%',v_sql2;
			END IF;
			
			v_sql3 = v_sql3 || ', sum("' || v_val || '")::TEXT';

		END LOOP ; 
	CLOSE curs1 ; 

	v_sql := 'WITH TEMPORARY_TABLE AS ( SELECT * from crosstab(' || chr(10) || E' \$$'||source_sql || E'\$$,'||chr(10) || E' \$$'||category_sql || E'\$$' || chr(10)|| ' ) AS (' || v_sql || '))' || ' SELECT ' || v_sql2  || ' FROM TEMPORARY_TABLE UNION ALL SELECT' || v_sql3 || ' FROM TEMPORARY_TABLE';

RETURN v_sql ;

END ;
$BODY$
  LANGUAGE 'plpgsql' VOLATILE COST 100
;

ALTER FUNCTION "public"."generate_crosstab_sql"("source_sql" text, "category_sql" text, "v_matrix_col_type" varchar, "v_matrix_rows_name_and_type" varchar) OWNER TO "postgres";



CREATE OR REPLACE FUNCTION "public"."generate_crosstab_sql_excel"("source_sql" text, "category_sql" text, "v_matrix_col_type" varchar, "v_matrix_rows_name_and_type" varchar)
  RETURNS "pg_catalog"."text" AS $BODY$ 

DECLARE
	v_sql TEXT ; curs1 refcursor ; v_val TEXT ; v_sql2 TEXT ; v_sql3 TEXT ;  v_sql4 TEXT ;   v_sql5 TEXT ;  

BEGIN
	v_sql = v_matrix_rows_name_and_type || ' TEXT' ; 
	
	v_sql2 = v_matrix_rows_name_and_type ; 
	
	v_sql3 = '';

	v_sql4 = chr(39) || 'Total' || chr(39) || '::TEXT AS ' || v_matrix_rows_name_and_type;

	v_sql5 = '';

	OPEN curs1 FOR EXECUTE category_sql ; 
		LOOP 
			FETCH curs1 INTO v_val ; 
			
			EXIT WHEN v_val IS NULL ; 
			
			v_sql = v_sql || ' , "' || v_val || '" ' || v_matrix_col_type ; 
			v_sql2 = v_sql2 || ' , COALESCE("' || v_val || '", 0)::TEXT AS "' || v_val || '"';
			IF v_val <> 'Total' THEN
			v_sql3 = v_sql3 || ', ROUND((COALESCE("' || v_val ||'"::DECIMAL,0) * 100/"Total"::DECIMAL), 1)::TEXT as "' || v_val ||' (%)"';
			END IF;
		
			v_sql4 = v_sql4 || ' , sum("' || v_val || '")::TEXT AS "' || v_val || '"'; 
			IF v_val <> 'Total' THEN
			v_sql5 = v_sql5 || ' , ' || chr(39) || chr(39) || '::TEXT AS "' || v_val || ' (%)"';
			END IF;

		END LOOP ; 
	CLOSE curs1 ; 

	v_sql := 'WITH TEMPORARY_TABLE AS ( SELECT * from crosstab(' || chr(10) || E' \$$'||source_sql || E'\$$,'||chr(10) || E' \$$'||category_sql || E'\$$' || chr(10)|| ' ) AS (' || v_sql || '))' || ' SELECT ' || v_sql2 || v_sql3  || ' FROM TEMPORARY_TABLE UNION ALL SELECT ' || v_sql4 || v_sql5 || ' FROM TEMPORARY_TABLE';

RETURN v_sql ;

END ;
$BODY$
  LANGUAGE 'plpgsql' VOLATILE COST 100
;

ALTER FUNCTION "public"."generate_crosstab_sql_excel"("source_sql" text, "category_sql" text, "v_matrix_col_type" varchar, "v_matrix_rows_name_and_type" varchar) OWNER TO "postgres";

CREATE OR REPLACE FUNCTION "public"."generate_crosstab_sql_plain"("source_sql" text, "category_sql" text, "v_matrix_col_type" varchar, "v_matrix_rows_name_and_type" varchar)
  RETURNS "pg_catalog"."text" AS $BODY$ 

DECLARE
	v_sql TEXT ; curs1 refcursor ; v_val TEXT ;

BEGIN
	v_sql = v_matrix_rows_name_and_type ; 

	OPEN curs1 FOR EXECUTE category_sql ; 
		LOOP 
			FETCH curs1 INTO v_val ; 
			
			EXIT WHEN v_val IS NULL ; 
			
			v_sql = v_sql || ' , "' || v_val || '" ' || v_matrix_col_type ;

		END LOOP ; 
	CLOSE curs1 ; 

	v_sql := 'SELECT * from crosstab(' || chr(10) || E' \$$'||source_sql || E'\$$,'||chr(10) || E' \$$'||category_sql || E'\$$' || chr(10)|| ' ) AS (' || v_sql || ')' ;

RETURN v_sql ;

END ;
$BODY$
  LANGUAGE 'plpgsql' VOLATILE COST 100
;

ALTER FUNCTION "public"."generate_crosstab_sql_plain"("source_sql" text, "category_sql" text, "v_matrix_col_type" varchar, "v_matrix_rows_name_and_type" varchar) OWNER TO "postgres";

CREATE OR REPLACE FUNCTION "public"."normal_rand"(int4, float8, float8)
  RETURNS SETOF "pg_catalog"."float8" AS '$libdir/tablefunc', 'normal_rand'
  LANGUAGE 'c' VOLATILE STRICT  COST 1
 ROWS 1000
;

ALTER FUNCTION "public"."normal_rand"(int4, float8, float8) OWNER TO "postgres";
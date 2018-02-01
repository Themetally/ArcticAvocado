import gulp        from 'gulp'
import sequence    from 'run-sequence'
import { modules } from './assets/gulp/gulp'
import stylus      from './assets/griddle-gulp/gridlover-stylus'

const {
		  configure,
		  yaml,
		  browser_sync,
		  scripts,
		  pot,
		  pack,
		  version,
		  utilities
	  } = modules

global.config = configure( yaml() )

// Register Tasks
gulp.task( 'sync', browser_sync )
gulp.task( 'scripts', scripts )
gulp.task( 'pot', pot )
gulp.task( 'styl', stylus )
gulp.task( 'pack', pack )
gulp.task( 'version', version )

gulp.task( 'build', () => {
	gulp.start( 'styl' )
	gulp.start( 'scripts' )
	gulp.start( 'pot' )
} )

gulp.task( 'dist', ( cb ) => {
	global.config.production = true

	return sequence(
		[ 'version', 'styl', 'scripts', 'pot' ],
		'pack',
		cb
	)
} )
public::	CurriculumVitae.tex
		texi2pdf -c -t '\\newcommand{\\varLang}[0]{ngerman}' -t '\\newcommand{\\varPrivate}[0]{0}' $<
		mv CurriculumVitae.pdf "Curriculum Vitae (Deutsch).pdf"
		texi2pdf -c -t '\\newcommand{\\varLang}[0]{british}' -t '\\newcommand{\\varPrivate}[0]{0}' $<
		mv CurriculumVitae.pdf "Curriculum Vitae (English).pdf"

private::	CurriculumVitae.tex
		texi2pdf -c -t '\\newcommand{\\varLang}[0]{ngerman}' -t '\\newcommand{\\varPrivate}[0]{1}' $<
		mv CurriculumVitae.pdf "Curriculum Vitae (Deutsch, private Version, mit Referenzen).pdf"
		texi2pdf -c -t '\\newcommand{\\varLang}[0]{british}' -t '\\newcommand{\\varPrivate}[0]{1}' $<
		mv CurriculumVitae.pdf "Curriculum Vitae (English, private version, includes character references).pdf"
